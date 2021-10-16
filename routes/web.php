<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;

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

Auth::routes();

Route::get('/email', function(){
    // return a new instance of the NewUserWelcomeClass
    return new NewUserWelcomeMail();
});

// A closure based controller
//Route::post('/follow/{user}', function() {
//    return['success'];
//});
Route::post('/follow/{user}', [FollowsController::class, 'store'])->name('follow.store');

Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');

// place the '/p/create' about '/p/{post}', so that the route mapper doesn't consider 'create' as a post_id
Route::get('/', [PostsController::class, 'index'])->name('post.index');
Route::get('/p/create', [PostsController::class, 'create'])->name('post.create');
Route::post('/p', [PostsController::class, 'store'])->name('post.store');
Route::get('/p/{post}', [PostsController::class, 'show'])->name('post.show');
