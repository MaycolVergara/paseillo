<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoriasRegistro', compact('categorias'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required'
        ]);

        $categoria = new Categoria();
        // 🌟 Verifica que el nombre en el input del HTML sea 'nombre_categoria'
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $categoria = Categoria::find($id);

        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();
        return redirect('/dashboard/categoriasRegistro');

    }

    public function delete($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect('/dashboard/categoriasRegistro');
    }
}
