<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory, Uuids;


    protected $table = 'jobs';

    protected $fillable = [
        'perusahaan',
        'user_id',
        'jabatan',
        'gaji',
        'jenis_pekerjaan',
        'tahun_masuk',
        'tahun_keluar',
        'pekerjaan_saatini'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}