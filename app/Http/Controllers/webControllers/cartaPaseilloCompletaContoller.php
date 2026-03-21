<?php

namespace App\Http\Controllers\webControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;


class cartaPaseilloCompletaContoller extends Controller
{
    public function cartaPaseilloCompleta()
    {

        $Hamburguesas = Product::where('id', 1)->get();
        $Pizzas = Product::where('id', 2)->get();
        $Krispys = Product::where('id', 3)->get();
        $Salchipapas = Product::where('id', 4)->get();
        $Alitas = Product::where('id', 5)->get();
        $Bebidas = Product::where('id', 6)->get();

        return view('web.cartaPaseilloCompleta', compact(
            'Hamburguesas',
            'Pizzas',
            'Krispys',
            'Salchipapas',
            'Alitas','Bebidas'));
    }
}
