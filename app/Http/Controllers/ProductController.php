<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Lista toda la carta.
     * Trae todos los productos y categorías para que veas qué tienes en stock.
     */
    public function index()
    {
        $products = ProductModel::all();
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
     * Valida que tenga nombre y precio, y si subes una foto, la guarda en la carpeta 'public'.
     */
    public function insertProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = new ProductModel();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        // Lógica de imagen: le pone un nombre único con el tiempo actual para que no se repitan
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('products', $imageName, 'public');
            $product->image = $imagePath;
        }

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
            return redirect('/dashboard/productList')->with('error', 'ProductModel not found');
        }
        return view('productEdit', compact('product', 'categories'));
    }

    /**
     * Actualiza los datos del producto.
     * Si subes una foto nueva, borra la foto antigua del servidor para no llenar el disco de basura.
     */
    public function update(Request $request, $id)
    {
        $product = ProductModel::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // Borra la imagen vieja si existe antes de guardar la nueva
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('products', $imageName, 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect('/dashboard/productList');
    }

    /**
     * Borra el producto para siempre.
     * También se encarga de eliminar el archivo de imagen del servidor.
     */
    public function delete($id)
    {
        $product = ProductModel::find($id);

        if ($product) {
            // Limpia el servidor borrando la foto del producto eliminado
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();
        }

        return redirect('/dashboard/productList');
    }
}
