<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Route::auth();

Route::get('/home',[
    'as'   => 'home.index',
    'uses' => 'HomeController@index'
]);

Route::get('template/generate/{template}',[
    'as'   => 'template.generate',
    'uses' => 'TemplateController@generate'
]);

Route::post('template/generatepdf',[
    'as'   => 'template.generatepdf',
    'uses' => 'TemplateController@generatePDF'
]);

Route::resource('template','TemplateController');
