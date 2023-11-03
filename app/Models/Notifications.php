<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory, Uuids;


    protected $table = "notifications";



    protected $fillable = [
        'user_id' , 
        'message' ,
        'type' , 
        'id_body'
    ];




}
