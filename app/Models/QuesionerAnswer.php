<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuesionerAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'quesioner_answer_detail_id', 'id_paket_quesioner_detail', 'answer_value'];
    protected $table = 'quesioner_answers';

    public function detail(): BelongsTo
    {
        return $this->belongsTo(PaketQuesionerDetail::class, 'id_paket_quesioner_detail')->orderBy('index');
    }

    function QuesinerAnswerDetail(): BelongsTo
    {
        return $this->belongsTo(QuesionerAnswerDetail::class, 'quesioner_answer_detail_id');
    }
}
