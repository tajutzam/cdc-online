<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $table = 'regency';

    protected $fillable = [
        'kode_kabupaten',
        'nama_kabupaten'
    ];
}