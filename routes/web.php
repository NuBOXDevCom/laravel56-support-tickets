<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Tickets
Route::middleware('auth')->group(function () {
    Route::get('new_ticket', 'TicketsController@create')->name('ticket.create');
    Route::post('new_ticket', 'TicketsController@store')->name('ticket.store');
    Route::get('my_tickets', 'TicketsController@userTickets')->name('tickets.user');
    Route::get('ticket/{ticket_id}', 'TicketsController@show')->name('ticket.show');
    Route::post('comment', 'CommentController@postComment')->name('comment');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('tickets', 'TicketsController@index')->name('admin.tickets');
    Route::post('close_ticket/{ticket_id}', 'TicketController@close')->name('admin.ticket.close');
});

