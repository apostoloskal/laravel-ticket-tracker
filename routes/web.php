<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('tickets.create'))
->name('home');

Route::resource('tickets', TicketController::class)
->only(['create', 'store', 'show']);