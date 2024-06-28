<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainCont;
use Illuminate\Auth\Events\Logout;

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

Route::get('/details', [MainCont::class,'index'])->name('home')->middleware('guard');

Route::get('/', [MainCont::class,'log'])->name('log');
Route::post('/', [MainCont::class,'val']);

Route::get('/logo', [MainCont::class,'logout'])->name('logout')->middleware('guard');



Route::get('/form', [MainCont::class,'form'])->name('form.create')->middleware('guard');
Route::post('/form', [MainCont::class,'sub'])->middleware('guard');
Route::get('/form/edit/{id}', [MainCont::class,'edit'])->name('form.edit')->middleware('guard');
Route::post('/form/update/{id}', [MainCont::class,'update'])->name('form.update')->middleware('guard');
// routes/web.php
Route::get('/file/{id}', [MainCont::class,'show'])->name('file.show')->middleware('guard');
Route::get('/delete/{id}', [MainCont::class,'delete'])->name('form.delete')->middleware('guard');
