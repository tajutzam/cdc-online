<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory, Uuids;

    protected $table = "password_resets";

    protected $fillable = [
        'email',
        'token',
        'user_id',
        'expire'
    ];

}
