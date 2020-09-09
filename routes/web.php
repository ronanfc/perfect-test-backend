<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::resource('clients', 'ClientsController');
    Route::resource('products', 'ProductsController');
    Route::resource('sales', 'SalesController');
    Route::get('searchClient','ClientsController@autoComplete')->name('searchClient');
});

Route::get('/', 'Admin\DashboardController@dashboard')->name('dashboard');
Route::post('/', 'Admin\DashboardController@dashboard')->name('reportSales');


/*
Telas para ver o funcionamento sem dados

Route::get('/', function () {
    return view('dashboard');
});
*/
Route::get('/sales', function () {
    return view('crud_sales');
});
Route::get('/products', function () {
    return view('crud_products');
});

Route::get('/login', ['as' => 'login', function () {
    return view('welcome');
}]);
