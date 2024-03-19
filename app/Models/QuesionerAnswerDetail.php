<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuesionerAnswerDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'id_paket_kuesioner', 'level'];
    protected $table = 'quesioner_answer_details';

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketKuesioner::class, 'id_paket_kuesioner');
    }
    public function quesioner_answer(): HasMany
    {
        return $this->hasMany(QuesionerAnswer::class, 'quesioner_answer_detail_id');
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
