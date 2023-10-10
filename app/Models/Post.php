<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Uuids;

    protected $table = 'post';
    

    protected $fillable = [
        'user_id',
        'link_apply',
        'description',
        'company',
        'position',
        'expired',
        'image'
    ];
}