<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = null;
    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];
}
