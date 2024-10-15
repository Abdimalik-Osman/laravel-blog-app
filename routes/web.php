<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


// Route::get('/', [BlogController::class, 'index'])->name('blogs.index');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
//     Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
//     Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
//     Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
//     Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
