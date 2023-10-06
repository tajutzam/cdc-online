<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competence';

    protected $fillable = [
        'f1761',
        'f1762',
        'f1763',
        'f1764',
        'f1765',
        'f1766',
        'f1767',
        'f1768',
        'f1769',
        'f1770',
        'f1771',
        'f1772',
        'f1773',
        'f1774',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}