<?php

namespace App\Application\Usecases\Delete\Interactors;

use App\Application\Usecases\Delete\DeleteUserUsecase;
use App\Domain\Repositories\UserRepository;
use App\Domain\Entities\User;

class DeleteUserInteractor implements DeleteUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId): void
    {
        $existingUser = $this->userRepository->findById($userId);
        if (!$existingUser) {
            throw new \InvalidArgumentException('User with this ID not found');
        }


        $this->userRepository->delete($userId);
    }
}
