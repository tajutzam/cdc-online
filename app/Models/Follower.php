<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory, Uuids;

    protected $table = 'folowers';

    protected $fillable = [
        'user_id',
        'folowers_id'
    ];

    public function followerDetails()
    {
        return $this->belongsTo(User::class, 'folowers_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}