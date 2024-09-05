<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(ItemController::class)->group(function(){
    Route::get('/buy','buy')->name('item.buy');
    Route::get('/item','index')->name('item.index');
    Route::get('/item/add', 'add')->name('item.create');
    Route::get('/item/save','create')->name('item.add');
    Route::get('/item/edit/{id}', 'edit')->name('item.edit');
    Route::put('/item/{id}', 'update')->name('item.update');
    Route::post('/item/save', 'store')->name('item.store');
    Route::get('/item/search','search')->name('item.search');
    Route::post('/buy','proccessbuy')->name('item.proccess');
    Route::delete('/item/{id}', 'destroy')->name('item.delete');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/','index')->name('user.index');
    Route::get('/login','login')->name('user.login');
    Route::get('/logout','logout')->name('user.logout');
    Route::post('/login','loginproccess')->name('user.login');
});

Route::controller(TransactionController::class)->group(function(){
    Route::post('/transaction','add')->name('transaction.add');
    Route::get('/transaction','index')->name('transaction.index');
    Route::get('/transaction/make','makeTransaction')->name('transaction.make');
    Route::get('/transaction/history/{id}','history')->name('transaction.history');
    Route::get('/transaction/{id}','startTransaction')->name('transaction.start');
    Route::post('/transaction/{id}','pay')->name('transaction.pay');
    Route::delete('/transaction/{transactionId}/{id}','destroy')->name('transaction.delete');
});