<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginCustomController;
use App\Http\Controllers\RegisterCustomController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    //Login Routes
    Route::get('login', [LoginCustomController::class, 'index'])->name('login');
    Route::post('custom-login', [LoginCustomController::class, 'customLogin'])->name('login.custom');
    //Registration Routes
    Route::get('registration', [RegisterCustomController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [RegisterCustomController::class, 'customRegistration'])->name('register.custom');
    //Forgot Password Routes 
    Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail'])->name('password.email');
    //Reset Password Routes
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordRoute'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});
//Homepage Route
Route::get('/', [HomepageController::class, 'homepage']);
//Logout Route 
Route::get('signout', [SignOutController::class, 'signOut'])->middleware('auth')->name('signout');
//Contact Route
Route::get('contact',[ContactController::class, 'viewContact']);
Route::post('contact',[ContactController::class, 'sendEmail'])->name('contact.send');
//Details Product
Route::post('details',[ProductsController::class, 'viewProductDetails'])->name('details.product');
//Account
Route::get('account', [HomepageController::class, 'accountView'])->middleware('auth');
//Change Password
Route::post('change-password', [ResetPasswordController::class, 'changePassword'])->middleware('auth.session');
//AutoComplete
Route::post('autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');
Route::post('search', [SearchController::class, 'autocomplete'])->name('search');
//Rating
Route::post('rating',[HomepageController::class, 'starRating'])->middleware('auth')->name('star.rating');
//Admin Route
Route::get('admin-products', [AdminController::class, 'viewAdminProducts'])->middleware('admin');
