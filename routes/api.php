<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerBallotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    // Endpoint de prueba
    Route::get('/test', function () {
        return response()->json(['success' => true, 'message' => 'API funcionando']);
    });

    // API para buscar DNI en RENIEC
    Route::get('/search-dni/{dni}', [customerBallotController::class, 'searchDni']);
});
