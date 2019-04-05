<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswers extends Model
{
    //
    protected $table = 'user_answers';

    protected $fillable = [
        'user_id', 'question_id', 'is_correct',
    ];



}
