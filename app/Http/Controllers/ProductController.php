<?php

namespace App\Http\Controllers;

use App\Models\Product; // Antes Productos
use App\Models\Category; // Antes Categoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller // Antes ProductosController
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('productList', compact('products', 'categories')); // Antes productosListado
    }

    public function insertProductView()
    {
        $categories = Category::all();
        return view('productRegistration', compact('categories')); // Antes productosRegistro
    }

    // INSERTAR
    public function insertProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'delivery_date' => 'nullable|date',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        // Si el usuario subió una imagen, la guardamos
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('products', $imageName, 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect('/dashboard/productList');
    }

    // EDITAR
    public function viewEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        if (!$product) {
            return redirect('/dashboard/productList')
                ->with('error', 'Product not found');
        }
        return view('productEdit', compact('product', 'categories')); // Antes productosEditar
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->delivery_date = $request->delivery_date;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {

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

    // ELIMINAR
    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();
        }

        return redirect('/dashboard/productList');
    }
}
