<?php

namespace App\Http\Controllers\webControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;


class cartaPaseilloCompletaContoller extends Controller
{
    public function cartaPaseilloCompleta()
    {

        $Hamburguesas = ProductModel::where('id', 1)->get();
        $Pizzas = ProductModel::where('id', 2)->get();
        $Krispys = ProductModel::where('id', 3)->get();
        $Salchipapas = ProductModel::where('id', 4)->get();
        $Alitas = ProductModel::where('id', 5)->get();
        $Bebidas = ProductModel::where('id', 6)->get();

        return view('web.cartaPaseilloCompleta', compact(
            'Hamburguesas',
            'Pizzas',
            'Krispys',
            'Salchipapas',
            'Alitas','Bebidas'));
    }
}
