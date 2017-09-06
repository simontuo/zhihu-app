<?php

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

Route::middleware('api')->get('/topics', 'TopicsController@topics');
Route::middleware('auth:api')->post('/question/follower', 'QuestionFollowController@follower');
Route::middleware('auth:api')->post('/question/follow', 'QuestionFollowController@followThisQuestion');
Route::get('/user/followers/{id}', 'FollowerController@index');
Route::post('/user/follow', 'FollowerController@follow');
Route::post('/answer/{id}/votes/users', 'VotesController@users');
Route::post('/answer/vote', 'VotesController@vote');
Route::post('/message/store', 'MessageController@store');
Route::get('/answer/{id}/comments', 'CommentsController@answer');
Route::get('/question/{id}/comments', 'CommentsController@question');
Route::post('/comment', 'CommentsController@store');
