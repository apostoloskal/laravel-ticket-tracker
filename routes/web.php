<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\StoreTicketCommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrackTicketController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', fn() => to_route('tickets.create'))
->name('home');

//Ticket comment
Route::post('/tickets/{ticket}/comment', StoreTicketCommentController::class)
->name('tickets.comment');

//Tickets search/track
Route::get('/tickets/track', TrackTicketController::class)
->name('tickets.track');
Route::post('/tickets/track', TrackTicketController::class);


//Tickets resource//
//Requires Authentication
Route::prefix('dashboard')
->middleware(['auth'])
->group(function() {
    Route::get('/', fn() => to_route('tickets.index'));
    Route::resource('tickets', TicketController::class)
    ->only(['index', 'edit', 'update', 'destroy']);
})
->name('dashboard');

//No Authentication
Route::get('tickets', fn() => to_route('tickets.create'));
Route::resource('tickets', TicketController::class)
->only(['create', 'store', 'show']);
//----------------//

//Login
Route::get('/login', fn() => view('auth.login'))
->name('login');
Route::post('/login', LoginController::class);
//Logout
Route::post('/logout', LogoutController::class)
->name('logout');