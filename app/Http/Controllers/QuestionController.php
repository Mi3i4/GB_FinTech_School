<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\UserAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    //
    public function index()
    {
        $data = Question::with('chapters','topics','answers')->paginate(10);
        //return response()->json($data, 200);
        return  json_encode($data);
    }

    public function question_random()
    {
        $id = intval(Input::get('id'));

        $questionAnswered = Question::whereHas('user_answers', function($q)
            {
            $q
                ->where('is_correct', '<=', '3')
                ->where('user_id' ,'=', Auth::id());

            })
            ->with('chapters','topics','answers','user_answers')
            ->where('chapters_id',$id)
            ->limit(4)
            ->inRandomOrder()
            ->get();

        $not_answered_count = 10 - $questionAnswered->count();

        $questionNew = Question
            ::whereDoesntHave('user_answers', function($q)
            {
                $q->where('user_id' ,'=', Auth::id());

            })
            ->with('chapters','topics','answers','user_answers')
            ->where('chapters_id',$id)
            ->limit($not_answered_count)
            ->inRandomOrder()
            ->get();

        $question = $questionAnswered->merge($questionNew);


        return response()->json($question, 200);
    }

    public function question_do_answer()
    {

        $answer_id = intval(Input::get('answer_id'));

        $answer = Answer::find($answer_id);

        $user_answer = UserAnswers::firstOrNew(
            ['user_id' => Auth::id(), 'question_id' => $answer->question_id]
        );

        if($answer->is_correct > 0){
            $user_answer->is_correct = $user_answer->is_correct +1;
            $user_answer->save();

        }

        echo 'answer:'.$user_answer->is_correct;
        return;

    }
}
