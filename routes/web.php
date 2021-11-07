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
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\CartController;
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
Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');
//Cart Routes
Route::get('cart', [CartController::class, 'viewCart'])->name('view.cart');
Route::post('/add-cart', [CartController::class, 'addToCart'])->name('add.cart');
//Category Filter
Route::post('category-filter', [HomepageController::class, 'categoryFilter'])->name('category.filter');
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
//Search
Route::post('autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');
Route::post('search', [SearchController::class, 'searchNavBar'])->name('search');
//Rating
Route::post('rating',[HomepageController::class, 'starRating'])->middleware('auth')->name('star.rating');
//Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('admin-main', [AdminController::class, 'viewAdmin'])->name('admin_main');
    //Admin Products
    Route::get('admin-product', [AdminController::class, 'viewAdminProduct'])->name('admin_product');
    Route::post('admin-product-delete', [AdminController::class, 'deleteProduct'])->name('admin_product_delete');
    Route::post('add-product', [AdminController::class, 'addProduct'])->name('add_product');
    Route::post('edit-product', [AdminController::class, 'editProduct'])->name('edit_product');
    Route::post('search-product', [AdminController::class, 'searchAdminProducts'])->name('search_admin_product');
    //Admin Users
    Route::get('admin-user', [UserAdminController::class, 'viewAdminUser'])->name('admin_user');
    Route::post('admin-user-delete', [UserAdminController::class, 'deleteUser'])->name('admin_user_delete');
    Route::post('add-user', [UserAdminController::class, 'addUser'])->name('add_user');
    Route::post('edit-user', [UserAdminController::class, 'editUser'])->name('edit_user');
    Route::post('search-user', [UserAdminController::class, 'searchAdminUser'])->name('search_admin_user');
    Route::post('autocomplete-user-admin', [SearchController::class, 'autocompleteAdminUser'])->name('autocomplete_user_admin');
    //Admin Categories 
    Route::get('admin-category', [CategoryAdminController::class, 'viewAdminCategory'])->name('admin_category');
    Route::post('add-category', [CategoryAdminController::class, 'addCategory'])->name('add_category');
    Route::post('admin-category-delete', [CategoryAdminController::class, 'deleteCategory'])->name('admin_category_delete');
    Route::post('edit-category', [CategoryAdminController::class, 'editCategory'])->name('edit_category');
    Route::post('search-category', [CategoryAdminController::class, 'searchAdminCategory'])->name('search_admin_category');
    Route::post('autocomplete-category-admin', [SearchController::class, 'autocompleteAdminCategory'])->name('autocomplete_category_admin');
    Route::post('change-category-admin', [AdminController::class, 'changeAdminCategory'])->name('change_category_admin');
});

