<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSection extends Model
{
    use HasFactory;

    protected $table = 'quis_main';

    protected $fillable = [
        'f8',
        'f504',
        'f502',
        'f505',
        'f5a1',
        'f5a2',
        'f506',
        'f1101',
        'f5b',
        'f5c',
        'f5d',
        'user_id',
    ];

    // Definisikan relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}