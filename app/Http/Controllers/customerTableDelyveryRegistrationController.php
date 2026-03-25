<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableDelivery;

class customerTableDelyveryRegistrationController extends Controller
{
    public function index()
    {

        $table_config = TableDelivery::orderBy('table_number', 'asc')->get();
        $table_view = TableDelivery::all();

        return view('customerTableDelyveryRegistration', compact('table_config', 'table_view'));
    }


    public function store(Request $request)
    {

        $inputTablesCostomer = $request->input('tablesCostomer');

        // Contamos cuántas mesas hay actualmente
        $countTablesDelivery = TableDelivery::count();

        if ($inputTablesCostomer > $countTablesDelivery) {
            // Creamos las mesas que faltan
            for ($i = $countTablesDelivery + 1; $i <= $inputTablesCostomer; $i++) {
                TableDelivery::create([
                    'table_number' => $i,
                    'status'       => 'disponible'
                ]);
            }
        } elseif ($inputTablesCostomer < $countTablesDelivery) {
            // Eliminamos las mesas sobrantes
            TableDelivery::where('table_number', '>', $inputTablesCostomer)
                ->delete();
        }

        // Redirigimos de vuelta a la pantalla
        return redirect('/dashboard/customerTableDelyveryRegistration')->with('success', 'Tables updated successfully');
    }
}
