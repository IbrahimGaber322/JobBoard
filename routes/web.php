<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsCandidate;
use App\Http\Middleware\EnsureIsEmployer;
use App\Http\Controllers\ApplicationController;

Route::get('/hello', [IndexController::class, 'show']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Routes for only verified users
Route::middleware('verified')->group(function () {

});

//Routes for admins only
Route::middleware([EnsureIsAdmin::class])->group(function () {

});

//Routes for employers only
Route::middleware([EnsureIsEmployer::class])->group(function () {
    // Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::get('/job', [JobController::class, 'index'])->name('job.index'); // Route for displaying jobs
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');

    // Route::get('/job/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
    // Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');
    // Route::delete('/job/{job}', [JobController::class, 'destroy'])->name('job.destroy');

    // Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');
    Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::post('/job/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('job.delete');
    Route::get('/applications', [ApplicationController::class, 'show'])->name('application.show');


});

//Routes for only candidates only
Route::middleware([EnsureIsCandidate::class])->group(function () {
    Route::get('/demo', [DemoController::class, 'index'])->name('demo');
    Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');
    Route::post('/job/{id}', [ApplicationController::class, 'store'])->name('application.store');
});



require __DIR__ . '/auth.php';
