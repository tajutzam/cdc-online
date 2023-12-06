<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraSubmission extends Model
{

    use HasFactory, Uuids;
    protected $table = 'mitra_submissions';

    protected $fillable = [
        'logo',
        'name',
        'nib',
        'business_license',
        'phone',
        'address',
        'email',
        'password',
    ];

    // Add any additional methods or relationships here
}
