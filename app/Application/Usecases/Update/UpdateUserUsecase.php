<?php

namespace App\Application\Usecases\Update;

use App\Domain\Entities\User;

interface UpdateUserUsecase
{
    public function execute(int $userId, array $userData): ?User;
}
