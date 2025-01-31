<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiftController;

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

Route::get('/', [GiftController::class, 'index'])->name('gifts.index');
Route::post('/gifts/select', [GiftController::class, 'store'])->name('gifts.store');
Route::get('/gifts/{id}/edit', [GiftController::class, 'edit'])->name('gifts.edit');
Route::put('/gifts/{id}', [GiftController::class, 'update'])->name('gifts.update');
Route::delete('/gifts/{id}', [GiftController::class, 'destroy'])->name('gifts.destroy');
