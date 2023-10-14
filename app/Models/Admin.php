<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory, Uuids;

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'npwp',
        'alamat',
        'email',
        'password',
        'role'
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id');
    }



}