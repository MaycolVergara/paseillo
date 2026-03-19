<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categoria;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use App\Models\Mesas;
use Illuminate\Support\Facades\Auth;

class MesasPedidosClientesController extends Controller
{
    // Añadimos $id para saber qué mesa estamos abriendo
    public function index($id)
    {
        $productos = Productos::all();
        $categorias = Categoria::all();

        // 1. Buscamos si la mesa tiene una venta activa (Pendiente)
        $ventaActiva = Ventas::where('id_mesa', $id)
            ->where('estado', 'Pendiente')
            ->first();

        // 2. Si tiene venta, traemos sus detalles y el total general. Si no, lo dejamos en 0.
        if ($ventaActiva) {
            $detalleVentas = DetalleVentas::where('id_venta', $ventaActiva->id_venta)->get();
            $totalGeneral = $ventaActiva->total;
        } else {
            $detalleVentas = collect(); // Lista vacía
            $totalGeneral = 0;
        }

        return view('detallePedidoMesasCliente',
            compact('productos', 'categorias', 'detalleVentas', 'totalGeneral', 'id'));
    }

    public function guardarPedido(Request $request, $id_mesa)
    {
        // 1. Validamos
        $request->validate([
            'id_producto' => 'required',
            'cantidad' => 'required|integer|min:1',
            'personalizado' => 'nullable|string'
        ]);

        // 2. Buscamos precio real
        $producto = Productos::find($request->id_producto);
        $precio_unitario = $producto->precio;
        $subtotal = $precio_unitario * $request->cantidad;

        // 3. Buscamos si la mesa ya tiene una orden "Pendiente"
        $venta = Ventas::where('id_mesa', $id_mesa)
            ->where('estado', 'Pendiente')
            ->first();

        // Si no tiene, creamos la Venta y buscamos el numero_mesa
        if (!$venta) {
            $mesaInfo = Mesas::find($id_mesa);

            $venta = new Ventas();
            $venta->id_mesa = $id_mesa;
            $venta->numero_mesa = $mesaInfo ? $mesaInfo->numero_mesa : $id_mesa;
            $venta->fecha = now();
            $venta->estado = 'Pendiente';
            $venta->total = 0;
            $venta->save();
        }

        // 4. Guardamos el detalle (¡AQUÍ FALTABAN ESTAS LÍNEAS!)
        $detalle = new DetalleVentas();
        $detalle->id_venta = $venta->id_venta;
        $detalle->id_producto = $request->id_producto;          // Recuperado
        $detalle->cantidad = $request->cantidad;                // Recuperado
        $detalle->precio_unitario = $precio_unitario;           // Recuperado
        $detalle->subtotal = $subtotal;                         // Recuperado
        $detalle->personalizado = $request->personalizado;      // Recuperado
        $detalle->save();

        // 5. Actualizamos el Total general de la Venta
        $venta->total = DetalleVentas::where('id_venta', $venta->id_venta)->sum('subtotal');
        $venta->save();

        // 6. Cambiar el estado de la mesa a 'ocupada'
        $mesaActual = Mesas::find($id_mesa);
        if ($mesaActual && $mesaActual->estado !== 'ocupada') {
            $mesaActual->estado = 'ocupada';
            $mesaActual->save();
        }

        // 6. Cambiar el estado de la mesa a 'ocupada' y ASIGNAR MOZO
        $mesaActual = Mesas::find($id_mesa);
        if ($mesaActual) {
            $mesaActual->estado = 'ocupada';

            // 🌟 USAMOS TU COLUMNA REAL
            $mesaActual->id_usuario_atendiendo = Auth::user()->id_usuario;

            $mesaActual->save();
        }
        return redirect()->back()->with('success', 'Producto añadido a la mesa');
    }

    public function generarBoleta($id_mesa)
    {
        // Buscamos la venta activa de esta mesa
        $venta = Ventas::where('id_mesa', $id_mesa)->where('estado', 'Pendiente')->first();

        // Si por error hacen clic y no hay pedidos, los devolvemos
        if (!$venta) {
            return redirect()->back()->with('error', 'No hay pedidos para emitir boleta.');
        }

        // Traemos los detalles y los productos para armar el ticket
        $detalleVentas = DetalleVentas::where('id_venta', $venta->id_venta)->get();
        $productos = Productos::all();

        return view('emitirBoleta', compact('venta', 'detalleVentas', 'productos'));
    }

// Asegúrate de que tu función reciba (Request $request, $id_mesa)
    public function finalizarVenta(Request $request, $id_mesa)
    {
        // 1. Buscamos la venta 'Pendiente'
        $venta = Ventas::where('id_mesa', $id_mesa)->where('estado', 'Pendiente')->first();

        if ($venta) {
            // 2. Cerramos la cuenta
            $venta->estado = 'Finalizado';

            // 3. Guardamos el método de pago
            $venta->metodo_pago = $request->input('metodo_pago', 'Efectivo');
            $venta->save();

            //  4. NUEVO: LIBERAMOS LA MESA Y AL MOZO
            $mesa = Mesas::find($id_mesa);
            if ($mesa) {
                $mesa->estado = 'disponible';

                // 🌟 LIMPIAMOS TU COLUMNA REAL
                $mesa->id_usuario_atendiendo = null;

                $mesa->save();
            }
        }

        return redirect('/dashboard/mesasView')->with('success', 'Venta finalizada y mesa liberada');
    }

    public function eliminarDetalle($id_detalle)
    {
        // 1. Buscamos la fila exacta del pedido
        $detalle = DetalleVentas::find($id_detalle);

        if ($detalle) {
            // 2. Buscamos la venta general (la mesa)
            $venta = Ventas::find($detalle->id_venta);

            if ($venta) {
                // 3. Le restamos al total lo que costaba ese producto eliminado
                $venta->total = $venta->total - $detalle->subtotal;
                $venta->save();
            }

            // 4. Borramos el producto de la base de datos
            $detalle->delete();
        }

        // 5. Recargamos la página al instante
        return redirect()->back()->with('success', 'Producto quitado de la orden');
    }
}
