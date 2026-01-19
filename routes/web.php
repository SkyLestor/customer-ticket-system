<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/ticket/create', [TicketController::class, 'create'])
        ->name('ticket.create');

    Route::get('/', [UserController::class, 'index'])
        ->name('dashboard');

    Route::get('/show/{ticket}', [TicketController::class, 'show'])
        ->name('ticket.show');

    Route::middleware(['admin'])->prefix('admin')->group(function () {

    });
});

require __DIR__ . '/settings.php';
