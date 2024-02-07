<?php

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Application\Usecases\Read\ReadUserUseCase;
use App\Application\Usecases\Update\UpdateUserUseCase;
use App\Application\Usecases\Delete\DeleteUserUseCase;
use App\Infrastructure\Models\Eloquent\EloquentUser;
use App\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends \App\Http\Controllers\Controller
{
    private $createUserUsecase;
    private $readUserUsecase;
    private $updateUserUseCase;
    private $deleteUserUseCase;

    public function __construct(
        CreateUserUseCase $createUserUsecase,
        // ReadUserUseCase $readUserUsecase,
        // UpdateUserUseCase $updateUserUseCase,
        // DeleteUserUseCase $deleteUserUseCase
    ) {
        $this->createUserUsecase = $createUserUsecase;
        // $this->readUserUsecase = $readUserUsecase;
        // $this->updateUserUseCase = $updateUserUseCase;
        // $this->deleteUserUseCase = $deleteUserUseCase;
    }
    public function store(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
        ]);
    
        try {
            // Dapatkan data dari permintaan
            $userData = $request->only(['username', 'password']);
    
            // Lanjutkan dengan menyimpan data
            $createdUser = $this->createUserUsecase->execute($userData);
    
            // Beri respons JSON dengan pesan sukses
            return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $createdUser], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }
    
}
