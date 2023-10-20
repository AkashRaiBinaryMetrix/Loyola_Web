<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class User_detail extends Model
{
    protected $table = "user_detail";
    protected $fillable = [
        'user_id',
        'phone', 
        'gender',
        'age',
        'city',
        'state',
        'country',
        'zipcode',
        'image',
    ];
}
