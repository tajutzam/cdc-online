<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuesionerType extends Model
{
    use HasFactory;
    protected $fillable = ['display_value', 'value'];
    protected $table = 'quesioner_types';
}
