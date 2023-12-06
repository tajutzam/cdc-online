<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory , Uuids;


    protected $fillable = [
        'va_number' , 'nominal' , 'bank'
    ];

}
