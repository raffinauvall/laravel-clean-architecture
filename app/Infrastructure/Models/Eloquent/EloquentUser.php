<?php

namespace App\Infrastructure\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = 'users';
    protected $fillable = ['username', 'password'];

  

    public static function rules()
    {
        return [
            'username' => 'required|unique:users|max:255',
            'phone_number' => 'required',
            'address' => 'required'
        ];
    }
}
