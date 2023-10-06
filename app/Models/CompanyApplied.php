<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyApplied extends Model
{
    use HasFactory;

    protected $table = 'company_applied';


    protected $fillable = [
        'f6',
        'f7',
        'f7a',
        'f1001',
        'f1002',
        'user_id',
    ];

    protected $casts = [
        'f6' => 'integer',
        'f7' => 'integer',
        'f7a' => 'integer',
    ];
}