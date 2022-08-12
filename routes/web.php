<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoListController;
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

Route::get('/{filter}', [ToDoListController::class,'index']);

Route::post('/usernameChange/{username}/{old}',[ToDoListController::class,'usernameChange'])->name('usernameChange');

Route::post('/taskTake/{username}/{id}',[ToDoListController::class,'taskTake'])->name('taskTake');

Route::post('/markDone/{id}',[ToDoListController::class,'markDone'])->name('markDone');

Route::post('/delete/{id}',[ToDoListController::class,'delete'])->name('delete');

Route::post('/saveItem',[ToDoListController::class,'saveItem'])->name('saveItem');
