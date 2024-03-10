<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuesionerAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'quesioner_answer_detail_id', 'id_paket_quesioner_detail', 'answer_value'];
    protected $table = 'quesioner_answers';
}
