<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function save(User $user): User;
    public function findById(int $userId): ?User;
    public function findByUsername(string $userUsername): ?User;
    public function update(User $user): User;
    public function delete(User $user): void;
}
