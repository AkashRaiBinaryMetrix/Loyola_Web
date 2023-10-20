<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SurveyCategory;


class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';
    
    protected $fillable = [
        'category_id',
        'image',
        'heading',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\SurveyCategory');
    }


}
