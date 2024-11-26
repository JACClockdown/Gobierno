<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard', [ItemsController::class, 'index'])->name('dashboard');
    Route::get('/create', [ItemsController::class, 'create'])->name('create');
    Route::post('/store', [ItemsController::class, 'store'])->name('store');
    Route::get('/me/{id}', [ItemsController::class, 'me'])->name('me');
    Route::put('/update/{id}', [ItemsController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ItemsController::class, 'delete'])->name('delete');

});
