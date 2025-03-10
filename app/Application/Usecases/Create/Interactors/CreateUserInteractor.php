<?php

namespace App\Application\Usecases\Create\Interactors;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

class CreateUserInteractor implements CreateUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $userData): User
{
    if (!isset($userData['username']) || !isset($userData['phone_number']) || !isset($userData['address'])) {
        throw new \InvalidArgumentException("All data are required");
    }

    $user = new User();
    $user->username = $userData['username']; 
    $user->phone_number = $userData['phone_number'];
    $user->address = $userData['address'];

    $savedUser = $this->userRepository->save($user);

    return $savedUser;
}

}
