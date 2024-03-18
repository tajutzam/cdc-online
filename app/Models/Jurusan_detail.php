<?php

namespace App\Models;

use Database\Seeders\QuisProdiSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan_detail extends Model
{
    use HasFactory;
    protected $fillable = ['quesioner_jurusans_id', 'quis_identitas_prodi_id'];
    protected $table = 'jurusan_details';

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(QuesionerJurusan::class, 'quesioner_jurusans_id');
    }
    public function prodi(): HasMany
    {
        return $this->hasMany(QuisionerProdi::class, 'id', 'quis_identitas_prodi_id');
    }
}
