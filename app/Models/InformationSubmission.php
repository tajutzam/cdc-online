<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationSubmission extends Model
{
    use HasFactory,Uuids;
    protected $table = 'information_submissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'description',
        'poster',
        'pay_id',
        'bank_id',
        'mitra_id',
        'bukti'
    ];

    public function pay()
    {
        return $this->belongsTo(Pay::class, 'pay_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }
}
