<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* Mostrar las categorias al admin */
    public function index()
    {
        $categories = Category::orderBy("id","desc")
        ->simplePaginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create" );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryController $request)
    {
        $category = $request->all();
        /* Validar si hay un archivo */
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }
        /* Guardar informacion */
        Category::created($category);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
