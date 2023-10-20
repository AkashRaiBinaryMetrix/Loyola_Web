<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;


class UserSurveyHistory extends Model
{
    use HasFactory;

    protected $table = 'user_survey_history';

    protected $fillable = 
    [
        'user_id',
        'survey_id',
        'status'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class,'survey_id','id');
    }




}
