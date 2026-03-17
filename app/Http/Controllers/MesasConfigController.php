<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesas;

class MesasConfigController extends Controller
{
    // Función para mostrar la vista
    public function index()
    {
        $mesas_config = Mesas::orderBy('numero_mesa', 'asc')->get();
        $mesas_view=Mesas::all();
        return view('mesasRegistros', compact('mesas_config', 'mesas_view'));
    }

    // Función que GUARDA en MySQL (Igual a tu Crud_Mesas.php)
    public function store(Request $request)
    {
        // Recibimos el número del input (ej: 14)
        $cantidadNueva = $request->input('cantidad');

        // SELECT COUNT(*) AS total FROM mesa
        $totalActual = Mesas::count();

        if ($cantidadNueva > $totalActual) {
            // INSERT INTO mesa (numero_mesa, estado) VALUES (?, 'disponible')
            for ($i = $totalActual + 1; $i <= $cantidadNueva; $i++) {
                Mesas::create([
                    'numero_mesa' => $i,
                    'estado'      => 'disponible' // Por defecto libres
                ]);
            }
        } elseif ($cantidadNueva < $totalActual) {
            // DELETE FROM mesa WHERE numero_mesa > ?
            Mesas::where('numero_mesa', '>', $cantidadNueva)->delete();
        }

        // Redirigimos de vuelta a la pantalla (Header Location)
        return redirect('/dashboard/mesasRegistros')->with('success', 'Guardado en MySQL correctamente');
    }
}
