<?php
// app/Models/PaketKuesioner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketKuesioner extends Model
{
    protected $fillable = ['judul', 'tipe', 'tanggal_dibuat'];
    protected $table = 'paket_kuesioners'; // Sesuaikan nama tabel di sini
}
