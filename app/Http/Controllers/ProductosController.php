<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        $categorias = Categoria::all();

        return view('productosListado', compact('productos', 'categorias'));
    }

    public function insertarProductosView()
    {
        $categorias = Categoria::all();
        return view('productosRegistro', compact('categorias'));
    }

    //INSERTAR

    public function insertarProductos(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion_producto' => 'nullable|string',
            'imagen_producto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'fecha_entrega' => 'nullable|date',
        ]);

        $producto = new Productos();
        $producto->nombre_producto = $request->nombre_producto;
        $producto->precio = $request->precio;
        $producto->fecha_entrega = $request->fecha_entrega;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->id_categoria = $request->id_categoria; // 👈 Guardamos la categoría

        // Si el usuario subió una imagen, la guardamos
        if ($request->hasFile('imagen_producto')) {
            $archivo = $request->file('imagen_producto');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $rutaImagen = $archivo->storeAs('productos', $nombreImagen, 'public');
            $producto->imagen_producto = $rutaImagen;
        }

        $producto->save();
        return redirect('/dashboard/productosListado');
    }

    //EDITAR
    public function viewEdit($id_producto)
    {
        $producto = Productos::find($id_producto);
        $categorias = Categoria::all();

        if (!$producto) {
            return redirect('/dashboard/productosListado')
                ->with('error', 'Producto no encontrado');
        }
        return view('productosEditar', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id_producto)
    {
        $producto = Productos::find($id_producto);

        $producto->nombre_producto = $request->nombre_producto;
        $producto->precio = $request->precio;
        $producto->fecha_entrega = $request->fecha_entrega;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->imagen_producto= $request->imagen_producto;
        $producto->id_categoria = $request->id_categoria; // 👈 Faltaba actualizar la categoría

        if ($request->hasFile('imagen_producto')) {

            if ($producto->imagen_producto) {
                Storage::disk('public')->delete($producto->imagen_producto);
            }

            $archivo = $request->file('imagen_producto');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $rutaImagen = $archivo->storeAs('productos', $nombreImagen, 'public');
            $producto->imagen_producto = $rutaImagen;
        }

        $producto->save();

        return redirect('/dashboard/productosListado');
    }

    //ELIMINAR
    public function delete($id_producto)
    {
        $producto = Productos::find($id_producto);

        if ($producto) {
            if ($producto->imagen_producto) {
                Storage::disk('public')->delete($producto->imagen_producto);
            }

            $producto->delete();
        }

        return redirect('/dashboard/productosListado');
    }
}
