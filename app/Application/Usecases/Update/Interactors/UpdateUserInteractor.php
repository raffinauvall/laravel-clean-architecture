<?php

namespace App\Application\Usecases\Update\Interactors;

use App\Domain\Entities\User;
use App\Application\Usecases\Update\UpdateUserUsecase;
use App\Domain\Repositories\UserRepository;

class UpdateUserInteractor implements UpdateUserUsecase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId, array $userData): ?User
    {
        // Periksa apakah pengguna dengan ID yang diberikan ada
        $existingUser = $this->userRepository->findById($userId);
        if (!$existingUser) {
            return null; // Mengembalikan null jika pengguna tidak ditemukan
        }

        // Validasi data yang diterima sebelum pembaruan
        if (!isset($userData['username']) || !isset($userData['password'])) {
            throw new \InvalidArgumentException('Username dan password wajib diisi.');
        }

        // Update data pengguna dengan data baru
        $this->userRepository->update($userId, $userData);

        // Ambil data pengguna yang diperbarui
        $updatedUser = $this->userRepository->findById($userId);

        return $updatedUser;
    }
}
