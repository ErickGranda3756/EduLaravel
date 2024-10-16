<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/* Principal */
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get("/all", [HomeController::class, 'all'])->name('home.all');
/* Administrador */
Route::get("/admin",[AdminController::class,"index"])->name("admin.index");
/* Rutas del admin */
Route::namespace("App\Http\Controllers")
    ->prefix("admin")
    /* Articulos */
    ->group(function () {
        Route::resource("articles", "ArticleController")
            ->except("show")
            ->names("articles");
            /* Categorias */
        Route::resource("categories", "CategoryController")
        /* Indicar las rutas que no se van a utilizar */
        ->except("show")
        ->names("categories");
        /* Comentarios */
        Route::resource("comments", "CommentController")
        ->only("index", "destroy")
        ->names("comments");
        /* Usuarios  */
        Route::resource("users", "UserController")
        ->except("create","store","show")
        ->names("users");
        /* Roles */
        Route::resource("roles", "RoleController")
        ->except("show")
        ->names("roles");
    });

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
/* Perfiles  */
Route::resource("profiles", ProfileController::class)
    ->only("edit", "update")
    ->names("profiles");

/* Ver articulos */
Route::get("/articles/{article}", [ArticleController::class, 'show'])->name('articles.show');
/* Ver articulos por categorias */
Route::get("/categories/{category}/articles", [CategoryController::class, 'detail'])->name('categories.detail');
/* Guardar los comentarios */
Route::post("/comment", [CommentController::class, 'store'])->name('comments.store');
Auth::routes();
/* Route::get("/articles",[ArticleController::class, 'index'])->name('articles.index');
Route::get("/articles/create",[ArticleController::class, 'create'])->name('articles.create');
Route::post("/articles",[ArticleController::class, 'store'])->name('articles.store');

Route::get("/articles/{article}/edit",[ArticleController::class, 'edit'])->name('articles.edit');
Route::put("/articles/{article}",[ArticleController::class, 'update'])->name('articles.update');
Route::delete("/articles/{article}",[ArticleController::class, 'destroy'])->name('articles.destroy');
 */
/*  */