<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'questions';


    public function topics()
    {
        return $this->belongsTo('App\Topic');
    }

    public function chapters()
    {
        return $this->belongsTo('App\Chapter');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function user_answers()
    {
        return $this->hasMany('App\UserAnswers');
    }
}
