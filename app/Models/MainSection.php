<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSection extends Model
{
    use HasFactory, Uuids;

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
    ];

    // Definisikan relasi jika diperlukan
    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }


    public function province()
    {
        return $this->belongsTo(Province::class, "f5a1");
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, "f5a2");
    }


}