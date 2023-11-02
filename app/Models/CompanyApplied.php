<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyApplied extends Model
{
    use HasFactory,Uuids;

    protected $table = 'company_applied';


    protected $fillable = [
        'f6',
        'f7',
        'f7a',
        'f1001',
        'f1002',
    ];

    protected $casts = [
        'f6' => 'integer',
        'f7' => 'integer',
        'f7a' => 'integer',
    ];

    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }
}