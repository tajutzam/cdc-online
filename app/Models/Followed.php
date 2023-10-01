<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followed extends Model
{
    use HasFactory , Uuids;

    protected $table = "folowed";

    protected $fillable = [
        'user_id',
        'folowed_id'
    ];

    public function followedDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
