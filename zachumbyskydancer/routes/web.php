<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::get('/otp-form', [AuthController::class, 'getOtpForm'])->name('otpform');

Route::post('/registration', [AuthController::class, 'registrationPost'])->name('registration.post');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/', [AuthController::class, 'getHomepage'])->name('homepage');
Route::get('/forgetpassword', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('/forgetManagerpassword', [AuthController::class, 'forgetManagerPassword'])->name('forgetManagerPassword');
Route::post('/forgetpassword', [AuthController::class, 'forgetPasswordPost'])->name('forgetPassword.post');
Route::post('/forgetManagerpassword', [AuthController::class, 'forgetManagerPasswordPost'])->name('forgetManagerPassword.post');

Route::get('/resetPassword/{phoneNo}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::get('/resetManagerPassword/{phoneNo}', [AuthController::class, 'resetManagerPassword'])->name('resetManagerPassword');

Route::post('/resetPassword/{phoneNo}', [AuthController::class, 'resetPasswordPost'])->name('resetPassword.post');
Route::post('/resetManagerPassword/{phoneNo}', [AuthController::class, 'resetManagerPasswordPost'])->name('resetManagerPassword.post');

Route::get('/aboutUs', [AuthController::class, 'aboutUs'])->name('aboutUs');
Route::get('/reservation', [AuthController::class, 'reservation'])->name('reservation');
Route::post('/reservation', [AuthController::class, 'reservationPost'])->name('reservation.post');
Route::post('/email-link', [AuthController::class, 'resetPasswordLink'])->name('reset-password-link');

Route::get('/menu', [AuthController::class, 'menu'])->name('menu');

// customer 
Route::group(['middleware' => 'auth'], function(){
    Route::get('/cart', [AuthController::class, 'cart'])->name('cart');
    Route::get('/invoice', [AuthController::class, 'getInvoice'])->name('getInvoice');

    Route::post('/add-to-cart/{menu_id}', [AuthController::class,'addToCart'])->name('cart.add');
    Route::put('/update-cart/{menu_id}', [AuthController::class,'updateCart'])->name('cart.update');
    Route::delete('/remove-from-cart/{menu_id}', [AuthController::class,'removeFromCart'])->name('cart.remove');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/submit/online-order', [AuthController::class, 'submitOnlineOrder'])->name('submit.online.order');
    Route::post('/submit/delivery-order', [AuthController::class, 'submitDeliveryOrder'])->name('submit.delivery.order');
    Route::post('/submit-qr-form', [AuthController::class, 'handleQrForm'])->name('submit.qr.form');

});



// manager routes 
Route::get('/managerlogin', [AuthController::class, 'managerlogin'])->name('managerlogin');
Route::post('/managerlogin', [AuthController::class, 'managerloginPost'])->name('managerlogin.post');

Route::group(['middleware' => 'auth'], function(){
    Route::delete('/deleteCustomer/{customer_id}',[ProductController::class, 'deleteCustomer'])->name('deleteCustomer');
    Route::delete('/deleteReservation/{reservation_id}',[ProductController::class, 'deleteReservation'])->name('deleteReservation');

    Route::get('/zdashboard',[ProductController::class, 'zdashboard'])->name('zdashboard');
    Route::get('/zcreatemenu',[ProductController::class, 'zcreatemenu'])->name('zcreatemenu');
    Route::delete('/deleteItem/{menu_id}',[ProductController::class, 'deleteItem'])->name('deleteItem');
    Route::put('/updateitem/{id}', [ProductController::class, 'updateItem'])->name('updateItem');
    Route::get('/updateMenu/{menu_id}',[ProductController::class, 'showUpdateMenu'])->name('showUpdateMenu');

    Route::post('/zcreatemenu', [ProductController::class, 'menuPost'])->name('createMenu.post');
    Route::get('/zevents',[ProductController::class, 'zevents'])->name('zevents');
    Route::get('/zcreateEvent',[ProductController::class, 'zcreateEvent'])->name('zcreateEvent');
    Route::post('/zcreateEvent', [ProductController::class, 'eventPost'])->name('createEvent.post');
    Route::delete('/deleteEvent/{event_id}',[ProductController::class, 'deleteEvent'])->name('deleteEvent');

    Route::get('/zreservation',[ProductController::class, 'zreservation'])->name('zreservation');
    Route::get('/zreservationPreview/{customer_id}/{reservation_id}',[ProductController::class, 'zreservationPreview'])->name('zreservationPreview');
    Route::get('/zcustomers',[ProductController::class, 'zcustomers'])->name('zcustomers');
    Route::get('/zorders',[ProductController::class, 'zorders'])->name('zorders');
    Route::get('/orderInvoice/{order_id}/{payment_id}',[ProductController::class, 'OrderInvoice'])->name('orderInvoice');
    Route::post('/updateStatus/{order_id}/{payment_id}', [ProductController::class, 'UpdateStatus'])->name('updateStatus');

    Route::get('/zpayment',[ProductController::class, 'zpayment'])->name('zpayment');
    Route::get('/paymentInvoice/{payment_id}/{item_id}',[ProductController::class, 'PaymentInvoice'])->name('paymentInvoice');

    Route::get('/zpaymentdetails/{customer_id}',[ProductController::class, 'zpaymentDetail'])->name('paymentDetail');
    Route::get('/zprofile',[ProductController::class, 'zprofile'])->name('zprofile');
    Route::post('/updateProfile', [ProductController::class, 'UpdateProfile'])->name('updateProfile');

    Route::get('/managerlogout', [AuthController::class, 'managerlogout'])->name('managerlogout');
});