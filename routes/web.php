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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

$this->get('registracija', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('registracija', 'Auth\RegisterController@register');




Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles', 'ArticleController@index');


Route::get('/vue', function () {
    return ['Laravel', 'Vue', 'Axios', 'AsJson'];
});

Route::get('/projects', 'ProjectController@index');

Route::post('/projects', 'ProjectController@save')->name('project-save');