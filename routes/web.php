<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'QuestionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::resource('questions', 'QuestionController', ['names' => [
    'create' => 'question.create',
    'show'   => 'question.show',
]]);

Route::post('questions/{question}/answer', 'AnswersController@store');

Route::get('question/{question}/follow', 'QuestionFollowController@follow');

Route::get('notifications', 'NotificationController@index');
Route::get('notifications/{notification}', 'NotificationController@show');

Route::get('inbox', 'InboxController@index');
Route::get('inbox/{dialogId}', 'InboxController@show');
Route::post('inbox/{dialogId}/store', 'InboxController@store');
