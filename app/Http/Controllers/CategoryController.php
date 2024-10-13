<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /* Proteger rutas */
    public function __construct()
    {
        /* Proteger las rutas */
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create','store');
        $this->middleware('can:categories.edit')->only('edit','update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    /* Mostrar las categorias al admin */
    public function index()
    {
        $categories = Category::orderBy("id", "desc")
            ->simplePaginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();
        /* Validar si hay un archivo */
        if ($request->hasFile('image')) {
            $category['image'] = $request->file('image')->store('categories');
        }
        /* Guardar informacion */
        Category::create($category);
        /* Redirigir al index */
        return redirect()->action([CategoryController::class, 'index'])
            ->with('success-create', 'Categoria creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        /* Si el usuario sube una imagen */
        if ($request->hasFile('image')) {
            /* Eliminar imagen anterior */
            File::delete(public_path('storage/' . $category->image));
            /* Asignar nueva imagen */
            $category['image'] = $request->file('image')->store('categories');
        }
        /* Actualizar datos */
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'state' => $request->state,
            'is_featured' => $request->is_featured,
        ]);
        /* Redirigir al index */
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-update', 'Categoría modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Eliminar imagen de la categoria
        if ($category->image) {
            File::delete(public_path('storage/' . $category->image));
        }
        /* Eliminar la categoria */
        $category->delete();
        /* Redirigir al index */
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-delete', 'Categoría eliminada con éxito');
    }
    /* Filtrar articulos por categorias */
    public function detail(Category $category)
    {
        $this->authorize("published", $category);
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);
            
        $navbar = Category::where([
            ["state", "1"],
            ["is_featured", "1"]
        ])->paginate(3);
        return view('subscriber.categories.detail', compact('articles', 'navbar', 'category'));
    }
}
