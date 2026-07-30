<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', fn() => to_route('tickets.create'))
->name('home');

//Login
Route::get('/login', fn() => view('auth.login'))
->name('login-view');
Route::post('/login', LoginController::class)
->name('login-post');
//Logout
Route::post('/logout', LogoutController::class)
->name('logout');

//Tickets resource
Route::resource('tickets', TicketController::class)
->only(['create', 'store', 'show']);