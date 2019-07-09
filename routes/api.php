<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Test routes
Route::prefix('/test')->group(function(){
    Route::get("/",                 "TestController@index");
    
    Route::get("/auth",             "TestController@auth")->middleware('auth:api');
});

Route::post('/register',            'Api\UsersController@create');

Route::post('/login',               'Api\UsersController@login');

Route::get('/chapter',              "ChapterController@index");

Route::get('/question',             "QuestionController@index");

Route::get('/answer',               "AnswerController@index");


// Routes with middleware auth:api
Route::middleware('auth:api')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/question_random',      "QuestionController@question_random")->middleware('auth:api');

    Route::post('/question_do_answer',  "QuestionController@question_do_answer")->middleware('auth:api');
});
