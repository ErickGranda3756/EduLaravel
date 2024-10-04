<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/* Principal */
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get("/all", [HomeController::class, 'all'])->name('home.all');
/* Articles */
Route::get("/articles",[ArticleController::class, 'index'])->name('articles.index');
Route::get("/articles/create",[ArticleController::class, 'create'])->name('articles.create');
Route::post("/articles",[ArticleController::class, 'store'])->name('articles.store');

Route::get("/articles/{article}/edit",[ArticleController::class, 'edit'])->name('articles.edit');
Route::put("/articles/{article}",[ArticleController::class, 'update'])->name('articles.update');
Route::delete("/articles/{article}",[ArticleController::class, 'destroy'])->name('articles.destroy');