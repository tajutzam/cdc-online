<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Uuids;


    protected $table = 'news';
    protected $fillable = [
        'title',
        'description',
        'image',
        'admin_id'
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class, "admin_id");
    }

}