<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'password'];

    // Tambahan properti atau metode sesuai kebutuhan
}
