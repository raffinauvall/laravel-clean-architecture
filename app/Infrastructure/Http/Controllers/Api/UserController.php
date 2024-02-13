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
use Illuminate\Support\Facades\Log;

class UserController extends \App\Http\Controllers\Controller
{
    private $createUserUsecase;
    private $readUserUsecase;
    private $updateUserUsecase;
    private $deleteUserUseCase;

    public function __construct(
        CreateUserUsecase $createUserUsecase,
        ReadUserUsecase $readUserUsecase,
        UpdateUserUsecase $updateUserUsecase,
        DeleteUserUseCase $deleteUserUseCase
    ) {
        $this->createUserUsecase = $createUserUsecase;
        $this->readUserUsecase = $readUserUsecase;
        $this->updateUserUsecase = $updateUserUsecase;
        $this->deleteUserUseCase = $deleteUserUseCase;
    }
    public function store(Request $request)
    {
        try {
            // Validasi permintaan
            $request->validate([
                'username' => 'required|unique:users|max:255',
                'password' => 'required|min:8',
            ]);

            $username = $request->input('username');
            $password = $request->input('password');

            // Hash Password Variable
            $hashPassword = Hash::make($password);

            // Panggil CreateUserUseCase untuk membuat pengguna baru
            $userData = [
                'username' => $username,
                'password' => $hashPassword,
            ];
            $createUser = $this->createUserUsecase->execute($userData);

            // Buat tampilan id
            $createUser->refresh();

            // 200 Success Message
            return response()->json(['message' => 'Data successfully added', 'data' => $createUser], 201);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Error Server
            return response()->json(['message' => 'Failed to add data: ' . $e->getMessage()], 500);
        }
    }



    // Function Get All User
    public function showAllUser()
    {
        $users = $this->readUserUsecase->execute();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'There are no user yet']);
        }

        // Mengonversi koleksi pengguna ke array asosiatif
        $userData = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password
                // Tambahkan atribut lain yang perlu Anda tampilkan
            ];
        });

        return response()->json($userData);
    }

    // Function Get User by Id
    public function showUserbyId(Request $request, $id)
    {
        $user = $this->readUserUsecase->execute($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User with this ID not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi permintaan
            $request->validate([
                'username' => 'required|max:255',
                'password' => 'required|min:8',
            ]);

            $username = $request->input('username');
            $password = $request->input('password');


            // Panggil UpdateUserUseCase untuk memperbarui pengguna
            $userData = [
                'username' => $username,
                'password' => Hash::make($password),
            ];
            $updatedUser = $this->updateUserUsecase->execute($id, $userData);

            // Berikan respons JSON yang sesuai dengan data yang diperbarui
            return response()->json(['message' => 'Data updated successfully', 'data' => $updatedUser], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani validasi gagal dan berikan respons JSON yang sesuai
            return response()->json(['message' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            // Tangani kesalahan lainnya dan berikan respons JSON yang sesuai
            return response()->json(['message' => 'Failed to update Data: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->deleteUserUseCase->execute($id);
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Error Server
            return response()->json(['message' => 'Failed to add data: ' . $e->getMessage()], 500);
        }
    }
}
