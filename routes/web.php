<?php

use App\Http\Controllers\AuthController;

// 1. Dashboard (Nombres actualizados a Inglés)
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableConfigController;
use App\Http\Controllers\TableCustomerOrderController;
use App\Http\Controllers\TableViewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;

// 2. WEB PUBLICA (CLIENTES) - INTACTO
use App\Http\Controllers\webControllers\WebController;
use App\Http\Controllers\webControllers\cartaPaseilloCompletaContoller;

use App\Http\Middleware\SoloAdmin;
use Illuminate\Support\Facades\Route;

// ==========================================================
// WEB PUBLICA (CLIENTES)
// ==========================================================
Route::group([], function () {
    Route::get('/', [WebController::class, 'index']);
    Route::get('/cartaPaseilloCompleta', [cartaPaseilloCompletaContoller::class, 'cartaPaseilloCompleta']);
});

// ==========================================================
// AUTENTICACION (LOGIN Y LOGOUT)
// ==========================================================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================================
// PANEL DE ADMINISTRACION Y VENTAS (DASHBOARD)
// ==========================================================
Route::prefix('dashboard')->middleware('auth')->group(function () {

    // ------------------------------------------------------
    // ACCESO GENERAL (Mozos y Administrador)
    // ------------------------------------------------------
    Route::get('/tableView', [TableViewController::class, 'index']);

    // Gestion de Pedidos y Boletas
    Route::get('/tableOrderDetails/{id}', [TableCustomerOrderController::class, 'index']);
    Route::post('/saveOrder/{table_id}', [TableCustomerOrderController::class, 'saveOrder']);
    Route::delete('/deleteDetail/{detail_id}', [TableCustomerOrderController::class, 'deleteDetail']);

    Route::get('/issueReceipt/{table_id}', [TableCustomerOrderController::class, 'generateReceipt']);
    Route::post('/finalizeSale/{table_id}', [TableCustomerOrderController::class, 'finalizeSale']);

    // ------------------------------------------------------
    // ACCESO RESTRINGIDO (Solo Administrador)
    // ------------------------------------------------------
    Route::middleware([SoloAdmin::class])->group(function () {

        // Inicio del Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Gestion de Productos
        Route::get('/productList', [ProductController::class, 'index']);
        Route::get('/productRegistration', [ProductController::class, 'insertProductView']);
        Route::post('/productRegistration', [ProductController::class, 'insertProduct']);
        Route::get('/products/{id}/edit', [ProductController::class, 'viewEdit'])->name('products.edit');
        Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}/delete', [ProductController::class, 'delete']);

        // Gestion de Categorias
        Route::get('/categoryRegistration', [CategoryController::class, 'index']);
        Route::post('/categoryRegistration', [CategoryController::class, 'create']);
        Route::put('/categoryRegistration/{id}/update', [CategoryController::class, 'update']);
        Route::delete('/categoryRegistration/{id}', [CategoryController::class, 'delete']);

        // Configuracion de Mesas
        Route::get('/tableRegistration', [TableConfigController::class, 'index']);
        Route::post('/tableRegistration/insert', [TableConfigController::class, 'store']);

        // Gestion de Usuarios
        Route::get('/userRegistration', [UserController::class, 'index']);
        Route::post('/userRegistration', [UserController::class, 'createUser']);
        Route::put('/userRegistration/{id}/update', [UserController::class, 'update']);
        Route::delete('/userRegistration/{id}', [UserController::class, 'delete']);

        // Reportes y Ventas
        Route::get('/saleDetails', [SaleController::class, 'index']);
    });
});
