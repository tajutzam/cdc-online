<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartSearchJob extends Model
{
    use HasFactory, Uuids;

    protected $table = 'start_search_jobs';

    protected $fillable = [
        'f301',
        'f302',
        'f303',
    ];

    // Relasi ke tabel 'users'

    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }
   
}