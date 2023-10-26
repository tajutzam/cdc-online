<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProdiAdministrator extends Authenticatable
{
    use HasFactory, Uuids;

    protected $table = 'prodi_administrator';
    protected $fillable = [
        'name',
        'email',
        'nik',
        'address',
        'password',
        'prodi_id'
    ];


    public function prodi()
    {
        return $this->belongsTo(QuisionerProdi::class, "prodi_id");
    }


}
