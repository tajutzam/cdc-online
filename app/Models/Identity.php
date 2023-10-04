<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory , Uuids;

    protected $table = 'quis_identitas';

    protected $fillable = [
        'kdptimsmh',
        'kdpstmsmh',
        'nimhsmsmh',
        'nmmhsmsmh',
        'telpomsmh',
        'emailmsmh',
        'tahun_lulus',
        'nik',
        'npwp',
        'user_id',
    ];

}