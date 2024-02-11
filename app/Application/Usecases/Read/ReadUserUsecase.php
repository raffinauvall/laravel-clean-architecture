<?php

namespace App\Application\Usecases\Read;

use App\Domain\Entities\User;

interface ReadUserUsecase
{
    public function execute(?int $userId = null);
}