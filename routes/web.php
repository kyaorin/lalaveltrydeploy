<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// 🔽 追加
use App\Http\Controllers\TweetController;
// 🔽 追加
use App\Http\Controllers\FavoriteController;
// 🔽 追加
use App\Http\Controllers\FollowController;
// 🔽 追加
use App\Http\Controllers\SearchController;
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
// 🔽 ここを編集
Route::middleware('auth')->group(function () {
    // 🔽 追加（検索画面）
  Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
  // 🔽 追加（検索処理）
  Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    // 🔽 追加
  Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    // 🔽 追加
  Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    // 🔽 2つ追加
  Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
  Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    // 🔽 2つ追加
  Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
  Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

  // 🔽 追加
  Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');    
  Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
