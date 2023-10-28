<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSuitability extends Model
{
    use HasFactory , Uuids;

    protected $table = 'job_suitability';

    protected $fillable = [
        'f1601',
        'f1602',
        'f1603',
        'f1604',
        'f1605',
        'f1606',
        'f1607',
        'f1608',
        'f1609',
        'f1610',
        'f1611',
        'f1612',
        'f1613',
        'f1614',
    ];

    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }

 
}