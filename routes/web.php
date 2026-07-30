<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTrackController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', fn() => to_route('tickets.create'))
->name('home');

//Login
Route::get('/login', fn() => view('auth.login'))
->name('login');
Route::post('/login', LoginController::class);
//Logout
Route::post('/logout', LogoutController::class)
->name('logout');

//Tickets search/track
Route::get('/tickets/track', TicketTrackController::class)
->name('tickets.track');
Route::post('/tickets/track', TicketTrackController::class);

//Tickets resource
Route::resource('tickets', TicketController::class)
->only(['create', 'store', 'show']);