<?php

Route::view('/', 'welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/guest_login', 'Auth\RegisterController@guestUserCreate')->name('guest_login');

Route::prefix('/upload')->group(function () {
    Route::get('', 'ItemController@show')->name("upload_form");
    Route::post('', 'ItemController@upload')->name("upload_image");    
});

Route::prefix('/list')->group(function () {
    Route::get('', 'ItemListController@show')->name("item_list");
    Route::post('', 'ShopController@receiveInfoGoodsToBuy');    
});

Route::prefix('/shop')->group(function () {
    Route::post('', 'ShopController@show')->name("item_list");
    Route::get('', 'ShopController@index');    
});

Route::post('/itemlist', 'ItemListController@edit');

Route::get('/shoplist', 'ShopListController@index');

Route::get('/delete_list', 'ItemListController@deleteList')->name('delete_list');

Route::post('/delete', 'ItemListController@delete');

Route::post('/charge', 'ChargeController@chargeAndChangeOwnership');

Auth::routes();