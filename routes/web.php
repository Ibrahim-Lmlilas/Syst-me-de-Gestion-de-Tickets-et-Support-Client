<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/categories', [App\Http\Controllers\AdminControllers::class, 'categoriesIndex'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [App\Http\Controllers\AdminControllers::class, 'categoriesCreate'])->name('admin.categories.create');
    Route::post('/admin/categories', [App\Http\Controllers\AdminControllers::class, 'categoriesStore'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [App\Http\Controllers\AdminControllers::class, 'categoriesEdit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [App\Http\Controllers\AdminControllers::class, 'categoriesUpdate'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [App\Http\Controllers\AdminControllers::class, 'categoriesDestroy'])->name('admin.categories.destroy');

    Route::get('/admin/tickets', [App\Http\Controllers\AdminControllers::class, 'ticketsIndex'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}/edit', [App\Http\Controllers\AdminControllers::class, 'ticketsEdit'])->name('admin.tickets.edit');
    Route::put('/admin/tickets/{ticket}', [App\Http\Controllers\AdminControllers::class, 'ticketsUpdate'])->name('admin.tickets.update');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/tickets', [App\Http\Controllers\UserController::class, 'ticketsIndex'])->name('user.tickets.index');
    Route::get('/user/tickets/create', [App\Http\Controllers\UserController::class, 'ticketsCreate'])->name('user.tickets.create');
    Route::post('/user/tickets', [App\Http\Controllers\UserController::class, 'ticketsStore'])->name('user.tickets.store');
    Route::get('/user/tickets/{ticket}/edit', [App\Http\Controllers\UserController::class, 'ticketsEdit'])->name('user.tickets.edit');
    Route::put('/user/tickets/{ticket}', [App\Http\Controllers\UserController::class, 'ticketsUpdate'])->name('user.tickets.update');
    Route::delete('/user/tickets/{ticket}', [App\Http\Controllers\UserController::class, 'ticketsDestroy'])->name('user.tickets.destroy');
});

Route::middleware(['auth', 'agent'])->group(function () {
    Route::get('/agent/dashboard', function () {
        return view('agent.dashboard');
})->name('agent.dashboard');
});

require __DIR__.'/auth.php';
