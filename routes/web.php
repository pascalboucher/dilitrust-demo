<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/documents', function () {
    return Inertia::render('Document/Index', [
        'documents' => [1,2,3], 
    ]);
})->middleware(['auth'])->name('documents');

Route::get('/documents/create', function () {
    return Inertia::render('Document/Create', [
        'status' => session('status'),
    ]);
})->middleware(['auth'])->name('documents.create');

require __DIR__.'/auth.php';
