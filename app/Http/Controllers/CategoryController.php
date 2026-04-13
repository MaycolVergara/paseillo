<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;


class CategoryController extends Controller // Antes CategoriaController
{
    // 1. Carga la lista de todas las categorías (Pizzas, Burgers, etc.) para mostrarlas en la tabla.
    public function index()
    {
        $categories = CategoryModel::all();
        $stores = StoreModel::all();
        return view('categoryRegistration', compact('categories', 'stores'));
    }

    // 2. Guarda una nueva categoría en la base de datos.
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new CategoryModel();
        $category->name = $request->name;
        $category->stores_id = $request->stores_id;
        $category->save();

        return redirect()->back()->with('success', 'Categoría creada con éxito');
    }

    // 3. Busca una categoría por ID y actualiza su nombre.
    public function update(Request $request, $id)
    {
        $category = CategoryModel::find($id);

        if (!$category) {
            return redirect('/dashboard/categoryRegistration')->with('error', 'Categoría no encontrada.');
        }

        $category->name = $request->name;
        $category->stores_id = $request->stores_id;
        $category->save();
        return redirect('/dashboard/categoryRegistration')->with('success', 'Categoría actualizada con éxito');
    }

    // 4. Elimina la categoría seleccionada de la base de datos.
    public function delete($id)
    {
        $category = CategoryModel::find($id);

        if (!$category) {
            return redirect('/dashboard/categoryRegistration')->with('error', 'Categoría no encontrada.');
        }

        $category->delete();
        return redirect('/dashboard/categoryRegistration');
    }
}
