<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuesionerJurusan extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_jurusan'];
    protected $table = 'quesioner_jurusans';

    public function detail(): HasMany
    {
        return $this->hasMany(Jurusan_detail::class, 'quesioner_jurusans_id', 'id');
    }
}
