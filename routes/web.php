<?php

use App\Http\Controllers\AuthController;

// 1. Dasboard
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MesasConfigController;
use App\Http\Controllers\MesasPedidosClientesController;
use App\Http\Controllers\MesasViewsController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VentasController;

// END

// 2. WEB PUBLICA (CLIENTES)
use App\Http\Controllers\webControllers\WebController;
use App\Http\Controllers\webControllers\cartaPaseilloCompletaContoller;
//END

use App\Http\Middleware\SoloAdmin;
use Illuminate\Support\Facades\Route;


//CONTRLADROESW
// ==========================================================
// WEB PUBLICA (CLIENTES)
// ==========================================================
Route::group([], function () {
    Route::get('/', [WebController::class, 'index']);
    Route::get('/cartaPaseilloCompleta', [cartaPaseilloCompletaContoller::class, 'cartaPaseilloCompleta']);
});


// ==========================================================
//AUTENTICACION (LOGIN Y LOGOUT)
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
    Route::get('/mesasView', [MesasViewsController::class, 'index']);

    // Gestion de Pedidos y Boletas
    Route::get('/detallePedidoMesasCliente', [MesasPedidosClientesController::class, 'index']);
    Route::get('/detallePedidoMesasCliente/{id}', [MesasPedidosClientesController::class, 'index']);
    Route::post('/guardarPedido/{id}', [MesasPedidosClientesController::class, 'guardarPedido']);
    Route::delete('/eliminarDetalle/{id_detalle}', [MesasPedidosClientesController::class, 'eliminarDetalle']);

    Route::get('/emitirBoleta/{id_mesa}', [MesasPedidosClientesController::class, 'generarBoleta']);
    Route::post('/finalizarVenta/{id_mesa}', [MesasPedidosClientesController::class, 'finalizarVenta']);


    // ------------------------------------------------------
    // ACCESO RESTRINGIDO (Solo Administrador)
    // ------------------------------------------------------
    Route::middleware([SoloAdmin::class])->group(function () {

        // Inicio del Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Gestion de Productos
        Route::get('/productosListado', [ProductosController::class, 'index']);
        Route::get('/productoRegistro', [ProductosController::class, 'insertarProductosView']);
        Route::post('/productoRegistro', [ProductosController::class, 'insertarProductos']);
        Route::get('/productos/{id_producto}/editar', [ProductosController::class, 'viewEdit'])->name('productos.edit');
        Route::put('/productos/{id_producto}/actualizar', [ProductosController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{id_producto}/eliminar', [ProductosController::class, 'delete']);

        // Gestion de Categorias
        Route::get('/categoriasRegistro', [CategoriaController::class, 'index']);
        Route::post('/categoriasRegistro', [CategoriaController::class, 'create']);
        Route::put('/categoriasRegistro/{id}/actualizar', [CategoriaController::class, 'update']);
        Route::delete('/categoriasRegistro/{id}', [CategoriaController::class, 'delete']);

        // Configuracion de Mesas
        Route::get('/mesasRegistros', [MesasConfigController::class, 'index']);
        Route::post('/mesasRegistros/insertar', [MesasConfigController::class, 'store']);

        // Gestion de Usuarios
        Route::get('/usuariosRegistro', [UsuariosController::class, 'index']);
        Route::post('/usuariosRegistro', [UsuariosController::class, 'createUsuario']);
        Route::put('/usuariosRegistro/{id_usuario}/actualizar', [UsuariosController::class, 'update']);
        Route::delete('/usuariosRegistro/{id_usuario}', [UsuariosController::class, 'delete']);

        // Reportes y Ventas
        Route::get('/detalleVentas', [VentasController::class, 'index']);
    });
});
