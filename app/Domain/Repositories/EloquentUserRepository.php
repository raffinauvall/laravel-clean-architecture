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
        return new User($eloquentUser->toArray()); // Membuat instance dari entitas domain
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

    public function findByUsername(string $userUsername): ?User
    {
        return EloquentUser::where('username', $userUsername)->first();
    }

    public function update(User $user): User
    {
        $eloquentUser = EloquentUser::find($user->id);
        $eloquentUser->update($user->toArray());
        return $eloquentUser;
    }

    public function delete(User $user): void
    {
        EloquentUser::destroy($user->id);
    }
}
