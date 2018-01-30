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


Auth::routes();


//Главная страница
Route::get('/',
    [
        'as'=>'home',
        'uses'=>'HomeController@index'
    ]);


//Бот
Route::post('bot',
    [
        'as'=>'bot',
        'uses'=>'HomeController@bot'
    ]);


/////////////////////////////*************************/////////////////////////////////
/////////////////////////////*******РЕДАКТОР******/////////////////////////////////
/////////////////////////////*************************/////////////////////////////////

Route::group(['middleware'=>['web','auth']], function() {


//Главная страница
	Route::get('Administrator/',
		[
			'as'=>'edit_home',
			'uses'=>'AdministratorController@index'
		]);


//Запрос на добавление нового объявления
    Route::post('Administrator/add',
        [
            'as' => 'add_ads',
            'uses' => 'AdministratorController@add_ads'
        ]);



//Открытие отдельно выбранной продукции
//    Route::get('Administrator/Production/{id?}',
//        [
//            'as'=>'edit_open_product',
//            'uses'=>'AdministratorController@open_product'
//        ]);




});




