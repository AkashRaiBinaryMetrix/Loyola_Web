<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SurveyQuestion;

class SurveyQuestionOption extends Model
{
    use HasFactory;

    protected $table = 'survey_question_options';

    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class,'question_id','id');
    }
    

}
