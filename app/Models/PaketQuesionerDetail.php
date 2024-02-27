<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketQuesionerDetail extends Model
{
    use HasFactory;
    protected $fillable = ['kode_pertanyaan', 'tipe', 'id_paket_quesioners', 'index'];
    protected $table = 'paket_quesioner_details';
}
