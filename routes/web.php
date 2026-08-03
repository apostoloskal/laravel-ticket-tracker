<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterEmployeeController;
use App\Http\Controllers\Employees\EmployeeController;
use App\Http\Controllers\Tickets\StoreCommentController;
use App\Http\Controllers\Tickets\TicketController;
use App\Http\Controllers\Tickets\TrackTicketController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', fn() => to_route('tickets.create'))
->name('home');

//Ticket comment
Route::post('/tickets/{ticket}/comment', StoreCommentController::class)
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
    Route::resource('employees', EmployeeController::class)
    ->only(['index', 'create', 'store', 'destroy']);

    Route::get('/', fn() => to_route('tickets.index'))
    ->name('dashboard');
    
    Route::resource('tickets', TicketController::class)
    ->only(['index', 'destroy']);
    Route::patch('tickets/{ticket}', [TicketController::class, 'update'])
    ->name('tickets.update');
    Route::patch('tickets/{ticket}/assign', [TicketController::class, 'assign'])
    ->name('tickets.assign');
});

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