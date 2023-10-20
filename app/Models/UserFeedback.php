<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserFeedback extends Model
{
    use HasFactory;

    protected $table = 'user_feedbacks';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
