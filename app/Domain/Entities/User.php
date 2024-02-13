<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'username', 'password'];

    // Tambahan properti atau metode sesuai kebutuhan
}
