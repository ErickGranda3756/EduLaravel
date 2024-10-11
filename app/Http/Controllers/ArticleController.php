<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* mostrar los articulos en el administrador */
        $user = Auth::user();
        $articles = Article::where("user_id", $user->id)
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
        $categories = Category::select(["id", "name"])
            ->where("state", "1")
            ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /* Obtengo datos de forma masiva */
    public function store(ArticleRequest $request)
    {
        $request->merge([
            "user_id" => Auth::user()->id,
        ]);
        /* Guardo la solicitud en una variable */
        /* Obtengo datos de forma masiva */
        $article = $request->all();
        /* Validar si hay un archivo en el reques */
        if ($request->hasFile('image')) {
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
    /* Ver los detalles y comentarios del articulo por parte del rol del subscrito */
    public function show(Article $article)
    {
        /* Validar que el archivo este visible controlandolo */
        $this->authorize('published', $article);
        $comments = $article->comments()->simplePaginate(5);
        return view("subscriber.articles.show", compact("article", "comments"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*Editar las categorias  */
    public function edit(Article $article)
    {
        /* Validar que el usuario sea el autor del articulo */
        $this->authorize('view', $article);
        /* Obtener categorias publicas */
        $categories = Category::select(["id", "name"])
            ->where("state", "1")
            ->get();
        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        /* Validar que el usuario sea el autor del articulo */
        $this->authorize('update', $article);
        /* Si el usuario sube una nueva imagen */
        if ($request->hasFile('image')) {
            /* Eliminar la imagen anterior */
            File::delete(public_path('storage/' . $article->image));
            /* Guardar la nueva imagen */
            $article["image"] = $request->file('image')->store('articles');
        }
        /* Actualizar los datos */
        $article->update([
            "title" => $request->title,
            "slug" => $request->slug,
            "introduction" => $request->introduction,
            "body" => $request->body,
            "user_id" => Auth::user()->id,
            "category_id" => $request->category_id,
            "status" => $request->status,
        ]);
        /* Redireccionar al usuario al index */
        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-update', 'Articulo modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        /* Validar que el usuario sea el autor del articulo */
        $this->authorize('delete', $article);
        //Elimina la imagen del articulo
        if ($article->image) {
            File::delete(public_path('storage/' . $article->image));
        }
        /* Elimnar articulo */
        $article->delete();
        /* Redireccionar al usuario al index */
        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-delete', 'Articulo eliminado con exito');
    }
}
