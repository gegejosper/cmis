<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\GraveyardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\StaffController;

Route::get('/', [FrontController::class, 'index']);
Route::get('/about', [FrontController::class, 'about']);
Route::get('/contact', [FrontController::class, 'contact']);
Route::get('/gardens', [FrontController::class, 'locations']);
Route::get('/gardens/view/{graveyard_id}', [FrontController::class, 'view_locations']);
Route::get('/search', [FrontController::class, 'search']);
Route::get('/gallery', [FrontController::class, 'gallery']);
Route::post('/search', [FrontController::class, 'search_result']);


Route::middleware('auth')->name('panel.')->prefix('panel/')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/user/{user}/assign-role', [AdminController::class, 'assignRoleToUser']);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('deceaseds', DeceasedController::class);
    Route::resource('visitors', VisitorController::class);
    Route::resource('users', UserController::class);
    Route::post('deceaseds/search', [AdminController::class, 'search_deceaseds']);
    Route::middleware('can:access-admin')->group(function(){
        Route::resource('graveyards', GraveyardController::class);
        Route::resource('blocks', BlockController::class);
    });
    
    Route::resource('visitors', VisitorController::class);
});
Route::middleware('auth')->name('panel.')->prefix('panel/')->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff');
});

require __DIR__.'/auth.php';
