<?php

namespace App\Application\UseCases\Create\Interactors;

use App\Application\UseCases\Create\CreateUserUseCase;
use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

class CreateUserInteractor implements CreateUserUseCase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $userData): User
    {
        // Validasi data, menerapkan aturan bisnis, dll.

        // Contoh: Membuat instansi User dari data yang diberikan
        $user = new User();
        $user->name = $userData['username'];
        $user->email = $userData['password'];

        // Simpan pengguna ke penyimpanan data (database)
        $savedUser = $this->userRepository->save($user);

        return $savedUser;
    }
}
