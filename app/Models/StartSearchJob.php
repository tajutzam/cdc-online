<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartSearchJob extends Model
{
    use HasFactory;

    protected $table = 'start_search_jobs';

    protected $fillable = [
        'f301',
        'f302',
        'f303',
        'user_id',
    ];

    // Relasi ke tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}