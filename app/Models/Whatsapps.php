<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapps extends Model
{
    use HasFactory, Uuids;


    protected $fillable = [
        'url',
        'image',
        'name'
    ];


    protected $table = 'whatsapps';

}
