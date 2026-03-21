<?php

namespace App\Http\Controllers;

use App\Models\Category; // Antes Categoria
use Illuminate\Http\Request;


class CategoryController extends Controller // Antes CategoriaController
{
    public function index()
    {
        $categories = Category::all();
        return view('categoryRegistration', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required' // Antes nombre_categoria
        ]);

        $category = new Category();
        // 🌟 Verifica que el nombre en el input del HTML sea 'name'
        $category->name = $request->name;
        $category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->save();
        return redirect('/dashboard/categoryRegistration');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/dashboard/categoryRegistration');
    }
}
