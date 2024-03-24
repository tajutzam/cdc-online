<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniSubmissions extends Model
{
    use HasFactory, Uuids;


    protected $fillable = [
        'alamat_domisili',
        'angkatan',
        'email',
        'jenis_kelamin',
        'jurusan',
        'nama_lengkap',
        'nim',
        'no_telp',
        'program_studi',
        'tahun_lulus',
        'tanggal_lahir',
        'tempat_lahir',
        'ijazah',
        'created_at',
        'updated_at'
    ];

    protected $table = 'alumni_submissions';
}
