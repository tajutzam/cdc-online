<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory, Uuids;


    protected $table = "questions";


    protected $fillable = [
        'questions',
        'answer',
        'name',
        'email',
        'subjek'
    ];

}
