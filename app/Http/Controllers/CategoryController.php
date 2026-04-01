<?php

namespace App\Http\Controllers;

use App\Models\Category; // Antes Categoria
use Illuminate\Http\Request;


class CategoryController extends Controller // Antes CategoriaController
{
    // 1. Carga la lista de todas las categorías (Pizzas, Burgers, etc.) para mostrarlas en la tabla.
    public function index()
    {
        $categories = Category::all();
        return view('categoryRegistration', compact('categories'));
    }

    // 2. Guarda una nueva categoría en la base de datos.
    public function create(Request $request)
    {
        // Valida que el nombre no llegue vacío.
        $request->validate([
            'name' => 'required' // Antes nombre_categoria
        ]);

        $category = new Category();
        // 🌟 Guarda el nombre enviado desde el formulario.
        $category->name = $request->name;
        $category->save();

        return redirect()->back();
    }

    // 3. Busca una categoría por ID y actualiza su nombre.
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->save();
        return redirect('/dashboard/categoryRegistration');
    }

    // 4. Elimina la categoría seleccionada de la base de datos.
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/dashboard/categoryRegistration');
    }
}
