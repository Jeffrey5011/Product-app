<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;


class CategoryController extends Controller
{


    public function index()
{
    try {
        $categories = Category::orderBy('name')->paginate(10);
        return view('category.index', compact('categories'));
    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Error al obtener categorías: ' . $e->getMessage());
    }
}
    public function create()
    {
        try {
            return view('category.create');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error creating category: ' . $e->getMessage());
        }
    }


public function store(Request $request)
{
    try {
        \App\Models\Category::create($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    } catch (\Exception $e) {
        return redirect()->route('categories.create')->with('error', 'Error creating category: ' . $e->getMessage());
    }
}

    // ...continúa igual para show, edit, update, destroy...

/**
 * Display the specified resource.
 */

public function show(string $id)
{
    try {
        $category = \App\Models\Category::with('products')->findOrFail($id);
        return view('category.show', compact('category'));
    } catch (\Exception $e) {
        return redirect()->route('categories.index')->with('error', 'Error mostrando categoría: ' . $e->getMessage());
    }
}
/**
 * Show the form for editing the specified resource.
 */
 public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('category.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error editando categoría: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.edit', $id)->with('error', 'Error actualizando categoría: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);

       
                $category->delete();
                return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');

            
            
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error eliminando categoría: ' . $e->getMessage());
        }
    }

}