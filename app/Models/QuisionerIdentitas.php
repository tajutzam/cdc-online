<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuisionerIdentitas extends Model
{
    use HasFactory;
    protected $table = 'quis_identitas';

    protected $fillable = [
        'kdpstmsmh',
        'nimhsmsmh',
        'nmmhsmsmh',
        'telpomsmh',
        'emailmsmh',
        'tahun_lulus',
        'nik',
        'npwp',
    ];
}