<?php

namespace App\Http\Controllers\webControllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductosController;
use App\Models\Productos;

class cartaPaseilloCompletaContoller extends Controller
{
    public function cartaPaseilloCompleta()
    {

        $Hamburguesas = Productos::where('id_categoria', 1)->get();
        $Pizzas = Productos::where('id_categoria', 2)->get();
        $Krispys = Productos::where('id_categoria', 3)->get();
        $Salchipapas = Productos::where('id_categoria', 4)->get();
        $Alitas = Productos::where('id_categoria', 5)->get();
        $Bebidas = Productos::where('id_categoria', 6)->get();

        return view('web.cartaPaseilloCompleta', compact(
            'Hamburguesas',
            'Pizzas',
            'Krispys',
            'Salchipapas',
            'Alitas','Bebidas'));
    }
}
