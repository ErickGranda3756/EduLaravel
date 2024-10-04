<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* mostrar los articulos en el administrador */
        $user = Auth::user();
        $articles = Article::where("user_id",$user-> id)
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);
            
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /* Redirige a la pagina para crear nuestro articulo */
    public function create()
    {
        /* Obtener categorias publicas */
        $categories = Category::select(["id","name"])
                ->where("state","1")
                ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /* Obtengo datos de forma masiva */
    public function store(ArticleRequest $request)
    {
        $request ->merge([
            "user_id" => Auth::user()->id,
        ]);
        /* Guardo la solicitud en una variable */
        /* Obtengo datos de forma masiva */
        $article = $request->all();
        /* Validar si hay un archivo en el reques */
        if($request->hasFile('image')){
            /* Guardar la imagen en la carpeta storage */
            $article['image'] = $request->file('image')->store('articles');
        }
        /* Ejecuta la accion*/
        Article::create($article);
        /* Redireccionar al index de los articulos */
        return redirect()->action([ArticleController::class, 'index'])
        ->with('success-create', 'Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
