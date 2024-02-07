<?php

namespace App\Application\Usecases\Create;

use App\Domain\Entities\User;

interface CreateUserUsecase
{
    public function execute(array $userData): User;
}
