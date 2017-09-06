<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Topic extends Model
{
    protected $fillable = [
        'name', 'questions_count', 'bio'
    ];

    public function questions()
    {
        $this->belongsToMany(Question::class)->withTimestamps();
    }
}
