<?php
// app/Models/PaketKuesioner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketKuesioner extends Model
{
    protected $fillable = ['judul', 'tipe', 'id_quis_identitas_prodi'];
    protected $table = 'paket_kuesioners'; // Sesuaikan nama tabel di sini

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(QuisionerProdi::class, 'id_quis_identitas_prodi');
    }
}
