<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionJawaban extends Model
{
    use HasFactory;
    protected $fillable = ['display_value', 'value', 'id_paket_quesioner_detail'];
    protected $table = 'option_jawabans'; // Sesuaikan nama tabel di sini
}
