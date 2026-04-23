<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Lista toda la carta.
     * Trae todos los productos y categorías para que veas qué tienes en stock.
     */
    public function index()
    {
        $products = ProductModel::withTrashed()->get();
        $categories = CategoryModel::all();

        return view('productList', compact('products', 'categories'));
    }

    /**
     * Abre el formulario para crear un plato nuevo.
     * Carga las categorías (Hamburguesas, Pizzas, etc.) para poder asignarlas.
     */
    public function insertProductView()
    {
        $categories = CategoryModel::all();
        return view('productRegistration', compact('categories'));
    }

    /**
     * Guarda el nuevo producto en la base de datos.
     * Valida que tenga nombre y precio.
     */
    public function insertProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = new ProductModel();
        $product->name = mb_strtoupper($request->name, 'UTF-8');
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect('/dashboard/productList');
    }

    /**
     * Muestra la pantalla para editar un producto.
     * Si el ID no existe, te regresa al listado con un aviso.
     */
    public function viewEdit($id)
    {
        $product = ProductModel::find($id);
        $categories = CategoryModel::all();

        if (!$product) {
            return redirect('/dashboard/productList')->with('error', 'Producto no encontrado');
        }
        return view('productEdit', compact('product', 'categories'));
    }

    /**
     * Actualiza los datos del producto.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = ProductModel::find($id);

        $product->name = mb_strtoupper($request->name, 'UTF-8');
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect('/dashboard/productList');
    }

    /**
     * Borra el producto para siempre (o soft delete dependiendo del modelo).
     */
    public function delete($id)
    {
        $product = ProductModel::find($id);

        if ($product) {
            $product->delete();
        }
        return redirect('/dashboard/productList');
    }

    /**
     * Habilita/Restaura un producto deshabilitado.
     */
    public function restore($id)
    {
        $product = ProductModel::withTrashed()->find($id);

        if ($product) {
            $product->restore();
        }
        return redirect('/dashboard/productList');
    }
}
