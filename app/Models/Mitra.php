<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Mitra extends Authenticatable
{
    use HasFactory, Uuids;

    protected $table = 'mitra';

    protected $fillable = [
        'logo',
        'name',
        'nib',
        'business_license',
        'phone',
        'address',
        'email',
        'password',
    ];
}
