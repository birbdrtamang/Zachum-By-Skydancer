<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Manager;

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
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    $manager = Manager::get();
    return view('dashboard',compact('manager'));
})->name('dashboard');

Route::get('/createmanager', function () {
    return view('createmanager');
})->name('createmanager');



Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/createmanager', [AuthController::class, 'createManager'])->name('createManager');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

Route::delete('/deleteManager/{id}',[AuthController::class,'deleteManager'])->name('deleteManager');
Route::put('/updateUser/{id}',[AuthController::class,'updateUser'])->name('updateUser');
Route::get('/forgetpassword', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forgetpassword', [AuthController::class, 'forgetPasswordPost'])->name('forgetPassword.post');
Route::get('/resetPassword/{phoneNo}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPassword/{phoneNo}', [AuthController::class, 'resetPasswordPost'])->name('resetPassword.post');


