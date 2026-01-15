<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/ticket/create', [TicketController::class, 'create'])
        ->name('ticket.create');

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
});

require __DIR__.'/settings.php';
