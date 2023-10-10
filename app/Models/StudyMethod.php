<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMethod extends Model
{
    use HasFactory;

    protected $table = 'study_method';

    protected $fillable = [
        'f21',
        'f22',
        'f23',
        'f24',
        'f25',
        'f26',
        'f27',
        'user_id',
    ];

    // Relasi ke tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
