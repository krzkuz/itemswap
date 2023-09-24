<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SwapController;

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

Route::middleware(['auth'])->group(function () {
    //Messages
    //Show message creation form
    Route::get(('/conversation/new'), [ConversationController::class, 'create'])->name('create-conversation');
    //Create message
    Route::post('messages/send/{conversation}', [MessageController::class, 'send'])->name('send-message');
    //Show messages
    Route::get('/messages/{conversation?}', [MessageController::class, 'messages'])->name('messages');

    //Swaps
    //Show user's swaps
    Route::get('/swaps', [SwapController::class, 'all'])->name('all-swaps');
    //Swap request
    Route::get('/swaps/new/{item}', [SwapController::class, 'create'])->name('swap-request');
    //Single swap
    Route::get('/swaps/{swap}', [SwapController::class, 'show'])->name('show-swap');
    //Swap create
    Route::post('/swaps', [SwapController::class, 'store'])->name('create-swap');
    //Swap confirm
    Route::get('swaps/confirm/{swap}', [SwapController::class, 'confirm'])->name('confirm-swap');

    //Pictures
    //Delete picture
    Route::delete('/picture/delete/{picture}', [ImageController::class, 'destroy'])->name('delete-picture');
    //Set main picture
    Route::post('/picture/set-main/{picture}', [ImageController::class, 'mainPicture'])->name('main-picture');

    //Users
    //Show edit profile form
    Route::get('/edit-profile', [UserController::class, 'edit'])->name('edit-profile');
    //Update profile
    Route::post('/update', [UserController::class, 'update'])->name('update-profile');

    //Items
    //Show logged user items
    Route::get('/items/manage', [ItemController::class, 'manage'])->name('manage-listings');
    //Show form to create item
    Route::get('/items/create', [ItemController::class, 'create'])->name('create-listing-form');
    //Create item in database
    Route::post('/items', [ItemController::class, 'store'])->name('create-listing');
    //Show form to edit item
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('edit-listing-form');
    //Show one item
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('show-listing');
    //Update item
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('update-listing');
    //Delete item
    Route::delete('/items/{item}', [ItemController::class, 'delete'])->name('delete-listing');
});

// Items
//Home page items
Route::get('/', [ItemController::class, 'index'])->name('home');
//Show one item
Route::get('/items/{item}', [ItemController::class, 'show'])->name('show-listing');

// Users
// Show registration form
Route::get('/register', [UserController::class, 'create'])->name('register');
//Create new user
Route::post('/users', [UserController::class, 'store'])->name('create-user');
//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login');
//Login user
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
//Logout user
Route::post('/logout', [UserController::class, 'logout'])->name('logout');