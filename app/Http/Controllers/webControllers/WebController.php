<?php

namespace App\Http\Controllers\webControllers;

use App\Http\Controllers\Controller;


class WebController extends Controller
{
    public function index()
    {

        return view('web.index');

    }

}
