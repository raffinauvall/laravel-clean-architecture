<?php

namespace App\Application\Usecases\Delete;

use App\Domain\Entities\User;

interface DeleteUserUsecase
{
    public function execute(int $userId): void;
}
