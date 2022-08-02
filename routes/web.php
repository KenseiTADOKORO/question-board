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

Route::get('/', 'QuestionsController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup/university', 'Auth\RegisterController@showRegisterUniversityForm')->name('signup.university');
Route::post('signup/university/department', 'Auth\RegisterController@showRegisterDepartmentForm')->name('signup.department');
Route::post('signup/university/department/course', 'Auth\RegisterController@showRegisterCourseForm')->name('signup.course');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('questions', 'QuestionsController', ['only' => ['store', 'show', 'edit', 'update', 'destroy']]);
    
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::get('questions', 'QuestionsController@create')->name('questions.create');
        
        Route::get('edit', 'UsersController@edit')->name('users.edit');
        Route::put('update', 'UsersController@update')->name('users.update');
        Route::post('image', 'UsersController@image')->name('users.image');
        Route::get('questionsList', 'UsersController@showQuestionsList')->name('users.question');
        Route::get('answersList', 'UsersController@showAnswersList')->name('users.answer');
        Route::delete('destroy', 'UsersController@destroy')->name('users.destroy');
        
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });
    
    Route::post('questions/{id}/answers', 'AnswersController@store')->name('answers.store');
    
    Route::resource('answers', 'AnswersController', ['only' => ['show', 'edit', 'update', 'destroy']]);
});
