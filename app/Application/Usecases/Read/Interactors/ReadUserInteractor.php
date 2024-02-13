<?php

namespace App\Application\Usecases\Read\Interactors;

use App\Application\Usecases\Read\ReadUserUsecase;
use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

class ReadUserInteractor implements ReadUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(?int $userId = null)
    {
        if ($userId !== null) {
            return $this->userRepository->findById($userId);
        } else {
            return $this->userRepository->getAll();
        }
    }
}
