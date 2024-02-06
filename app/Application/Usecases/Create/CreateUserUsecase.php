<?php

namespace App\Application\UseCases\Create;

use App\Domain\Entities\User;

interface CreateUserUseCase
{
    public function execute(array $userData): User;
}
