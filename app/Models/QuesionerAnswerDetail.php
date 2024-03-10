<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuesionerAnswerDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'id_paket_kuesioner'];
    protected $table = 'quesioner_answer_details';
}
