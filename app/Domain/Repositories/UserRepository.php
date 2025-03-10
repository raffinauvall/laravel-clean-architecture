<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use Illuminate\Support\Collection; 

interface UserRepository
{
    public function save(User $user): User;
    public function findById(int $userId): ?User;
    public function getAll(): Collection;
    public function update(int $userId, array $userData): ?User;
    public function delete(int $userId): void;
}
