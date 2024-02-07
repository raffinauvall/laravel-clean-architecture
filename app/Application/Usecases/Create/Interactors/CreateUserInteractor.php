<?php

namespace App\Application\Usecases\Create\Interactors;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

class CreateUserInteractor implements CreateUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $userData): User
    {
        // Validasi data
        if (!isset($userData['username']) || !isset($userData['password'])) {
            throw new \InvalidArgumentException("Username and password are required.");
        }
    
        // Contoh: Membuat instansi User dari data yang diberikan
        $user = new User();
        $user->username = $userData['username']; // Ubah 'name' menjadi 'username' jika sesuai
        $user->password = $userData['password']; // Ubah 'email' menjadi 'password' jika sesuai
    
        // Simpan pengguna ke penyimpanan data (database)
        $savedUser = $this->userRepository->save($user);
    
        return $savedUser;
    }
    
}

