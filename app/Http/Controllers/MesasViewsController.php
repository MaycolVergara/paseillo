<?php

namespace App\Http\Controllers;
use App\Models\Mesas;
use Illuminate\Http\Request;

class MesasViewsController extends Controller
{
    public function index()
    {
        $mesas_views = Mesas::all();
        return view('mesasView', compact('mesas_views'));
    }
}
