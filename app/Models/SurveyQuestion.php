<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOption;
use App\Models\UserQuestionAnswer;
use App\Models\Survey;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $table = 'survey_questions';
    

    public function option()
    {
        return $this->hasMany('App\Models\SurveyQuestionOption','question_id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class,'survey_id','id');
    }

   
}
