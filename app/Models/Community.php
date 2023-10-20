<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    
    protected $table = 'community';
     protected $fillable = [
        'title',
        'description',
        'image'
    ];

    public function allcommunity()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => route('home.dashboard').'/public/community/'.$this->image,
            'cover_image' => route('home.dashboard').'/public/community/'.$this->cover_image,
            'created_at' => $this->created_at,
        ];
    }
}
