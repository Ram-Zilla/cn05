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


//Продукция
Route::get('Production',
    [
        'as'=>'production',
        'uses'=>'HomeController@production'
    ]);


//Открытие отдельно выбранной категории продукции
Route::get('ProductionCategory/{id?}',
    [
        'as'=>'open_product_category',
        'uses'=>'HomeController@open_product_category'
    ]);


//Открытие отдельно выбранной продукции
Route::get('Production/{id?}',
    [
        'as'=>'open_product',
        'uses'=>'HomeController@open_product'
    ]);


//Контакты
Route::get('Contacts',
    [
        'as'=>'contacts',
        'uses'=>'HomeController@contacts'
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
	Route::get('Edit/home',
		[
			'as'=>'edit_home',
			'uses'=>'EditorController@index'
		]);


//Странца со списком видов продукции
    Route::get('Edit/Production',
        [
            'as'=>'edit_production',
            'uses'=>'EditorController@production'
        ]);


//Запрос на добавление нового продукции
    Route::post('Edit/AddProduct',
        [
            'as'=>'add_product',
            'uses'=>'EditorController@add_product'
        ]);


//Открытие отдельно выбранной продукции
    Route::get('Edit/Production/{id?}',
        [
            'as'=>'edit_open_product',
            'uses'=>'EditorController@open_product'
        ]);

});




