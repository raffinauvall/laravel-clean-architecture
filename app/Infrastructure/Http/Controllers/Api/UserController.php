<?php

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Application\Usecases\Read\ReadUserUsecase;
use App\Application\Usecases\Update\UpdateUserUsecase;
use App\Application\Usecases\Delete\DeleteUserUsecase;
use App\Domain\Entities\User;
use App\Infrastructure\Models\Eloquent\EloquentUser;
use App\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends \App\Http\Controllers\Controller
{
    private $createUserUsecase;
    private $readUserUsecase;
    private $updateUserUseCase;
    private $deleteUserUseCase;

    public function __construct(
        CreateUserUseCase $createUserUsecase,
        ReadUserUseCase $readUserUsecase,
        // UpdateUserUseCase $updateUserUseCase,
        // DeleteUserUseCase $deleteUserUseCase
    ) {
        $this->createUserUsecase = $createUserUsecase;
        $this->readUserUsecase = $readUserUsecase;
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
            $createUser = User::create([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
            ]);
            // 200 Success Message
            return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $createUser], 201);
        } catch (\Exception $e) {
            // Error Server
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }

    // Function Get All User
    public function showAllUser(Request $request)
    {
        $users = $this->readUserUsecase->execute();

        if ($users === null) {
            return response()->json(['message' => 'Belum ada user.']);
        }
        return response()->json($users);
    }

    // Function Get User by Id
    public function showUserbyId(Request $request, $id)
    {
        $user = $this->readUserUsecase->execute($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
    }
}
