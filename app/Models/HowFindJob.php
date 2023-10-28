<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowFindJob extends Model
{
    use HasFactory,Uuids;

    protected $table = 'how_to_find_jobs';

    protected $fillable = [
        'f401',
        'f402',
        'f403',
        'f404',
        'f405',
        'f406',
        'f407',
        'f408',
        'f409',
        'f410',
        'f411',
        'f412',
        'f413',
        'f414',
        'f415',
        'f416',
    ];

    protected $casts = [
        'f401' => 'boolean',
        'f402' => 'boolean',
        'f403' => 'boolean',
        'f404' => 'boolean',
        'f405' => 'boolean',
        'f406' => 'boolean',
        'f407' => 'boolean',
        'f408' => 'boolean',
        'f409' => 'boolean',
        'f410' => 'boolean',
        'f411' => 'boolean',
        'f412' => 'boolean',
        'f413' => 'boolean',
        'f414' => 'boolean',
        'f415' => 'boolean',
    ];

    public function quisionerLevel()
    {
        return $this->hasOne(QuisionerLevel::class);
    }
}