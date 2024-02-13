<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository as UserRepositoryInterface;
use App\Infrastructure\Models\Eloquent\EloquentUser;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(User $user): User
    {
        $eloquentUser = EloquentUser::create($user->toArray());
        return new User($eloquentUser->toArray());
    }

    public function findById(int $userId): ?User
    {
        $eloquentUser = EloquentUser::find($userId);
        return $eloquentUser ? new User($eloquentUser->toArray()) : null;
    }

    public function getAll(): Collection
    {
        $eloquentUsers = EloquentUser::all();
        $users = new Collection();

        foreach ($eloquentUsers as $eloquentUser) {
            $user = new User($eloquentUser->toArray());
            $users->push($user);
        }

        return $users;
    }

    public function update(int $userId, array $userData): ?User
    {
        // Cari pengguna berdasarkan ID
        $existingUser = EloquentUser::find($userId);

        // Jika pengguna tidak ditemukan, kembalikan null
        if (!$existingUser) {
            return null;
        }

        // Perbarui data pengguna
        $existingUser->update($userData);

        // Kembalikan pengguna yang diperbarui
        return new User($existingUser->fresh()->toArray());
    }


    public function delete(int $userId): void
    {
        EloquentUser::destroy($userId);
    }
}
