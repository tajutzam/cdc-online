<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurtheStudy extends Model
{
    use HasFactory;

    protected $table = 'furthe_study';


    protected $fillable = [
        'f18a',
        'f18b',
        'f18d',
        'f1201',
        'f1202',
        'f14',
        'f15',
        'user_id',
    ];

    protected $casts = [
        'f18d' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}