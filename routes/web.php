<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/* Principal */
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get("/all", [HomeController::class, 'all'])->name('home.all');
/* Articles */
/* Metodo mas rapido */
Route::resource("articles", ArticleController::class)
    ->except("show")
    ->names("articles");
/* Categorias */
Route::resource("categories", CategoryController::class)
    /* Indicar las rutas que no se van a utilizar */
    ->except("show")
    ->names("categories");
/* Comentarios */
Route::resource("comments", CommentController::class)
    ->only("index", "destroy")
    ->names("comments");




/* Ver articulos */
Route::get("/articles/{article}", [ArticleController::class, 'show'])->name('articles.show');
/* Ver articulos por categorias */
Route::get("/categories/{category}/articles", [ArticleController::class, 'detail'])->name('categories.detail');
/* Guardar los comentarios */
Route::get("/comment", [CommentController::class, 'store'])->name('comments.store');
Auth::routes();
/* Route::get("/articles",[ArticleController::class, 'index'])->name('articles.index');
Route::get("/articles/create",[ArticleController::class, 'create'])->name('articles.create');
Route::post("/articles",[ArticleController::class, 'store'])->name('articles.store');

Route::get("/articles/{article}/edit",[ArticleController::class, 'edit'])->name('articles.edit');
Route::put("/articles/{article}",[ArticleController::class, 'update'])->name('articles.update');
Route::delete("/articles/{article}",[ArticleController::class, 'destroy'])->name('articles.destroy');
 */
/*  */