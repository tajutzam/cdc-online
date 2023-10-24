<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiAdministrator extends Model
{
    use HasFactory, Uuids;


    protected $table = 'prodi_administrator';
    protected $fillable = [
        'name',
        'email',
        'nik',
        'address',
        'password'
    ];


    public function prodi()
    {
        return $this->belongsTo(QuisionerProdi::class, "prodi_id");
    }


}
