<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use Illuminate\Support\Collection; // Ganti Illuminate\Database\Eloquent\Collection dengan Illuminate\Support\Collection

interface UserRepository
{
    public function save(User $user): User;
    public function findById(int $userId): ?User;
    public function getAll(): Collection; // Ubah tipe kembalian menjadi Illuminate\Support\Collection
    public function findByUsername(string $userUsername): ?User;
    public function update(User $user): User;
    public function delete(User $user): void;
}
