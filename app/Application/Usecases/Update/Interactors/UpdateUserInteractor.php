<?php

namespace App\Application\Usecases\Update\Interactors;

use App\Domain\Entities\User;
use App\Application\Usecases\Update\UpdateUserUsecase;
use App\Domain\Repositories\UserRepository;

class UpdateUserInteractor implements UpdateUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId, array $userData): ?User
    {
        $existingUser = $this->userRepository->findById($userId);
        if (!$existingUser) {
            return null;
        }


        if (!isset($userData['username']) || !isset($userData['phone_number']) || !isset($userData['address'])) {
            throw new \InvalidArgumentException('All fields are required.');
        }
        $this->userRepository->update($userId, $userData);

        $updatedUser = $this->userRepository->findById($userId);

        return $updatedUser;
    }
}
