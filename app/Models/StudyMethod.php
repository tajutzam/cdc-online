<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMethod extends Model
{
    use HasFactory,Uuids;

    protected $table = 'study_method';

    protected $fillable = [
        'f21',
        'f22',
        'f23',
        'f24',
        'f25',
        'f26',
        'f27',
    ];

    // Relasi ke tabel 'users'

    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }
  
}

