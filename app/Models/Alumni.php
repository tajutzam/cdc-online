<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;


    protected $table = 'alumni';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'angkatan',
        'email',
        'jenis_kelamin',
        'jurusan',
        'nama_lengkap',
        'nim',
        'no_telp',
        'program_studi',
        'tahun_lulus',
    ];
}
