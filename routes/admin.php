<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);
    Route::get('categories/b/trash', [CategoryController::class, 'trach'])->name('categories.trash');
    Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force.delete');

    Route::resource('menus', MenuController::class);
    Route::get('menus/b/trash', [MenuController::class, 'trach'])->name('menus.trash');
    Route::get('menus/{id}/restore', [MenuController::class, 'restore'])->name('menus.restore');
    Route::delete('menus/{id}/force-delete', [MenuController::class, 'forceDelete'])->name('menus.force.delete');


    Route::resource('tables', TableController::class);
    Route::get('tables/b/trash', [TableController::class, 'trach'])->name('tables.trash');
    Route::get('tables/{id}/restore', [TableController::class, 'restore'])->name('tables.restore');
    Route::delete('tables/{id}/force-delete', [TableController::class, 'forceDelete'])->name('tables.force.delete');


    Route::resource('reservations', ReservationController::class);
    Route::get('reservations/b/trash', [ReservationController::class, 'trach'])->name('reservations.trash');
    Route::get('reservations/{id}/restore', [ReservationController::class, 'restore'])->name('reservations.restore');
    Route::delete('reservations/{id}/force-delete', [ReservationController::class, 'forceDelete'])->name('reservations.force.delete');


});

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
