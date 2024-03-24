<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketQuesionerDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'kode_pertanyaan',
        'pertanyaan',
        'tipe_id',
        'id_paket_quesioners',
        'is_required',
        'options',
        'index'
    ];
    protected $table = 'paket_quesioner_details';

    public function tipe(): BelongsTo
    {
        return $this->belongsTo(QuesionerType::class, 'tipe_id');
    }
}
