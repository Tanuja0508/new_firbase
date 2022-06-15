<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;


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
    return view('welcome');
});

Route::get('/dashboard',[HomeController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/home',[HomeController::class,'home'])->middleware(['auth'])->name('home');
// Route::get('/home',function(){
//     return view('chat');
// });

Route::post('/dashboard',[HomeController::class,'createChat'])->name('home.createChat');
Route::post('/send_mssg',[HomeController::class,'createChat']);
Route::post('/get_chat_data',[HomeController::class,'get_chat']);

// Route::post('send-notification',[NotificationController::class,'sendNotification']);

// Route::post('/home','HomeController@createChat')->name('home.createChat');


require __DIR__.'/auth.php';
