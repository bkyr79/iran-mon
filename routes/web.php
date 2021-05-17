<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', 
	[App\Http\Controllers\ItemController::class, "show"]
	)->name("upload_form");

Route::post('/upload', 
	[App\Http\Controllers\ItemController::class, "upload"]
	)->name("upload_image");

Route::get('/list',
    [App\Http\Controllers\ItemListController::class, "show"]
    )->name("item_list");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shop', function () {
    return view('shop');
    });

Route::post('/shop', 
    [App\Http\Controllers\ShopController::class, "show"]
    )->name("item_list");

Route::post('/list', 'ShopController@edit');

Route::get('/shoplist', 'ShopListController@index');

Route::post('/itemlist', 'ItemListController@edit');

Route::get('/delete_list', 'ItemListController@deleteList')->name('delete_list');

Route::post('/delete', 'ItemListController@delete');

Route::post('/charge', 'ChargeController@charge');