<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuesionerJurusan extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_jurusan'];
    protected $table = 'quesioner_jurusans';
}
