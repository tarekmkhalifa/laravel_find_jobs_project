<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



// index page show all listings
Route::get('/', [ListingController::class, 'index'])->name('index');
// create listing page
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
// store listing into db
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
// edit listing page
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');
// update listing in db
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');
// delete listing in db
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth');
// manage listings page
Route::get('/listings/manage', [ListingController::class, 'manageListings'])->middleware('auth');
// show single listing
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('show');


// show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
// create new user
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
// log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
// login user
Route::post('/users/login', [UserController::class, 'authenticate']);
// show profile page
Route::get('/profile', [UserController::class,'profile'])->middleware('auth');
// update profile
Route::post('/profile', [UserController::class,'update'])->middleware('auth');

Auth::routes(['verify' => true]);
