<?php

use App\Http\Controllers\reactjs_message;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("/message_from_reactjs", function () {
    return view("/message_from_reactjs");
})->name("reactjsMessage");



Route::post('/reactmessage', [reactjs_message::class, 'sendingResponse']);
Route::get('/view_message', [reactjs_message::class, 'returning_view'])->name("view_react_message");
Route::get("/getmessage", [reactjs_message::class, 'sending_data_back']);
