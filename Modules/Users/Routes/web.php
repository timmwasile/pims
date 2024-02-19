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

use Modules\Users\Http\Controllers\UsersController;

Route::prefix('users')->group(function () {
    Route::get('/profile', 'UsersController@index')->name('profile');
});

Route::prefix('users_educations')->group(function () {
    Route::post('/list', 'UserEducationsController@store')->name('user-education');
});
Route::prefix('user_profile')->group(function () {
    Route::any('/information/', 'ProfileController@store')->name('user-profile');
});
Route::prefix('users_experience')->group(function () {
    Route::post('/list', 'UserEducationsController@store')->name('user-experience');
});

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

Route::prefix('users')->group(function () {
    Route::get('/profile', 'UsersController@index')->name('profile');
});

Route::prefix('users_educations')->group(function () {
    Route::post('/list', 'UserEducationsController@store')->name('user-education');
});

Route::prefix('users_experiences')->group(function () {
    Route::post('/list', 'UserExperiencesController@store')->name('user-experience');
});

Route::prefix('users_skills')->group(function () {
    Route::post('/list', 'UserSkillsController@store')->name('user-skill');
});
