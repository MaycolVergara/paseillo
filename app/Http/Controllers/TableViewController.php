<?php

namespace App\Http\Controllers;

use App\Models\Table; // Antes Mesas
use Illuminate\Http\Request;

class TableViewController extends Controller // Antes MesasViewsController
{
    public function index()
    {
        $table_views = Table::all(); // Antes mesas_views
        return view('tableView', compact('table_views')); // Antes mesasView
    }
}
