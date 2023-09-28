<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, Uuids;

    protected $table = 'education';

    protected $fillable = [
        "id",
        "user_id",
        "strata",
        "jurusan",
        "prodi",
        "tahun_masuk",
        "tahun_lulus",
        "no_ijasah",
        "perguruan"
    ];



}