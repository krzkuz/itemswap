<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;

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
// Items
//Home page items
Route::get('/', [ItemController::class, 'index']);
//Show logged user items
Route::get('/items/manage', [ItemController::class, 'manage']);
//Show form to create item
Route::get('/items/create', [ItemController::class, 'create']);
//Create item in database
Route::post('/items', [ItemController::class, 'store']);
//Show form to edit item
Route::get('/items/{item}/edit', [ItemController::class, 'edit']);
//Show one item
Route::get('/items/{item}', [ItemController::class, 'show']);
//Update item
Route::put('/items/{item}', [ItemController::class, 'update']);
//Delete item
Route::delete('/items/{item}', [ItemController::class, 'delete']);
//Swap item request



// Users
// Show registration form
Route::get('/register', [UserController::class, 'create']);
//Create new user
Route::post('/users', [UserController::class, 'store']);
//Show login form
Route::get('/login', [UserController::class, 'login']);
//Login user
Route::post('/authenticate', [UserController::class, 'authenticate']);
//Logout user
Route::post('/logout', [UserController::class, 'logout']);
//Show edit profile form
Route::get('/edit-profile', [UserController::class, 'edit'])->name('edit-profile');
//Update profile
Route::post('/update', [UserController::class, 'update'])->name('update-profile');


//Pictures
//Delete picture
Route::delete('/picture/delete/{picture}', [ImageController::class, 'destroy'])->name('delete-picture');
//Set main picture
Route::post('/picture/set-main/{picture}', [ImageController::class, 'mainPicture'])->name('main-picture');


//Messages
//Show message creation form
Route::get(('/conversation/new'), [ConversationController::class, 'create'])->name('create-conversation');
//Create message
Route::post('messages/send/{conversation}', [MessageController::class, 'send'])->name('send-message');
//Show messages
Route::get('/messages/{conversation?}', [MessageController::class, 'messages'])->name('messages');

