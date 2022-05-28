<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

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

// Route::get('/', function () {
//     return view('loginpage');
// });



Route::view('/login', 'loginpage')->name('loginpage');

Route::post('users/logging_in', [UserController::class, 'doLogin'])->name('login');


Route::group(['middleware'=>'auth'],function(){

    Route::view('/', 'welcome')->name('welcome');

    Route::get('users/logging_out', [UserController::class, 'doLogout'])->name('logout');

    Route::resource('students', StudentController::class);
    
});




