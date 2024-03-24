<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory, Uuids;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'comment',
        'post_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}