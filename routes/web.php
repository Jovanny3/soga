<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController; 
use App\Http\Middleware\Authenticate;   
use App\Http\Controllers\ClubController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\CommentController;






Route::get('/', function () {
   
    return view('home');

});

Route::get('/home', [UserController::class, 'index'])->middleware(['auth'])->name('home');


Route::post('/home', [PostController::class, 'store'])->name('store');
Route::post('/community', [FriendController::class, 'addFriend'])->name('friend-store');
Route::post('/notifications', [CommentController::class, 'store'])->name('comments-store');
//Route::post('/search', [HomeController::class, 'searchStore'])->name('search-store');
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::post('/search', [UserController::class, 'search'])->name('search');

Route::get('/community', [UserController::class, 'community'])->middleware(['auth'])->name('community');
Route::post('/community', [FriendController::class, 'addFriend'])->name('friend-store');



//Route::get('/notifications', [UserController::class, 'notifications'])->middleware(['auth'])->name('notifications');
Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications');
Route::post('/notifications', [CommentController::class, 'store'])->name('comments-store');
Route::put('/notifications', [FriendController::class, 'requestFriend'])->name('friend-request');

Route::get('/settings-profile/{id}', [UserController::class, 'settingsProfile'])->middleware(['auth'])->name('settings-profile');
Route::post('/settings-profile/{id}', [UserController::class, 'addCompany'])->name('settings-profile-professional');
Route::put('/settings-profile/{id}', [UserController::class, 'addAboutUser'])->name('add-about-user');

//Route::post('/messages', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::get('/messages/{userId}', [MessageController::class, 'getMessages'])->name('messages.get');
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('messages.show');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

Route::get('/criar-postagem', function () {
    return view('posts.posts'); })->name('criar-postagem');
    Route::post('/posts', [PostController::class, 'store'])->name('store');

    

    Route::get('/group/{id}', [ClubController::class, 'getCommunitys'])->middleware(['auth'])->name('group');
    Route::get('/new-group', [ClubController::class, 'newGroup'])->middleware(['auth'])->name('new-group');
    Route::post('/group', [ClubController::class, 'createNewCommunity'])->middleware(['auth'])->name('new-group-store');

    Route::get("/profile/{id}", [UserController::class, 'profile'])->middleware(['auth'])->name('profile');


Route::post('/home', [PostController::class, 'store'])->name('store');
Route::post('/community', [FriendController::class, 'addFriend'])->name('friend-store');
Route::post('/notifications', [CommentController::class, 'store'])->name('comments-store');
Route::post('/search', [UserController::class, 'searchStore'])->name('search-store');
Route::post('/settings-profile/{id}', [UserController::class, 'addCompany'])->name('settings-profile-professional');
Route::post('/group', [ClubController::class, 'createNewCommunity'])->middleware(['auth'])->name('new-group-store');

    
    Route::resource('posts', 'PostController');
    Route::post('/home', [PostController::class, 'store'])->name('store');

    Route::post('/posts/{post}/like', [\App\Http\Controllers\LikeController::class,'like'])->name('posts.like');
    Route::post('/posts/{post}/comment', 'PostController@comment')->name('posts.comment');

    Route::post('/posts/{post}/like', 'LikeController@store')->name('posts.like');
    Route::get('/posts/{post}/likes', 'LikeController@index')->name('posts.likes');

    Route::put('/home', [UserController::class, 'update'])->name('update');
Route::put('/notifications', [FriendController::class, 'requestFriend'])->name('friend-request');
Route::put('/profile/{id}', [UserController::class, 'store'])->name('user-store');
Route::put('/settings-profile/{id}', [UserController::class, 'addAboutUser'])->name('add-about-user');
Route::put('/group/{id}', [ClubController::class, 'participateInTheCommunity'])->middleware(['auth'])->name('groups-store');
    


    require __DIR__.'/auth.php';



