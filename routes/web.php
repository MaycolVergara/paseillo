<?php

use App\Http\Controllers\AuthController;

// 1. Dashboard (Nombres actualizados a Inglés)
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TableCustomerOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableCustomerOrderDeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TablesDeliveryController;
use App\Http\Controllers\StaffReportController;


// 2. WEB PUBLICA (CLIENTES) - INTACTO
use App\Http\Controllers\webControllers\WebController;
use App\Http\Controllers\webControllers\CartaPaseilloCompletaController;

use App\Http\Middleware\SoloAdmin;
use Illuminate\Support\Facades\Route;

// ==========================================================
// WEB PUBLICA (CLIENTES)
// ==========================================================
Route::group([], function () {
    Route::get('/', [WebController::class, 'index']);
    Route::get('/cartaPaseilloCompleta', [CartaPaseilloCompletaController::class, 'cartaPaseilloCompleta']);
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
    // SECCIÓN 1: PEDIDOS DEL SALÓN FÍSICO (MESAS NORMALES)
    // ------------------------------------------------------
    // Estas rutas las usan los mozos para las mesas del local
    Route::get('/tableView', [TableController::class, 'index']);
    Route::get('/tableOrderDetails/{id}', [TableCustomerOrderController::class, 'index']);
    Route::post('/saveOrder/{table_id}', [TableCustomerOrderController::class, 'saveOrder']);
    Route::delete('/deleteDetail/{detail_id}', [TableCustomerOrderController::class, 'deleteDetail']);
    Route::get('/issueReceipt/{table_id}', [TableCustomerOrderController::class, 'generateReceipt']);
    Route::post('/finalizeSale/{table_id}', [TableCustomerOrderController::class, 'finalizeSale']);

    // ------------------------------------------------------
    // ACCESO RESTRINGIDO (Solo Administrador)
    // ------------------------------------------------------
    Route::middleware([SoloAdmin::class])->group(function () {

        // Inicio y Reportes
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/saleDetails', [SaleController::class, 'index']);

        // Configuración del Sistema (Branding)
        Route::get('/setting', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('settings.update');

        // ------------------------------------------------------
        // SECCIÓN 2: GESTIÓN DE MESAS (CONFIGURACIÓN)
        // ------------------------------------------------------
        // Configuración Salón Físico
        Route::get('/tableRegistration', [TableController::class, 'viewTableForm']);
        Route::post('/tableRegistration/insert', [TableController::class, 'store']);

        // Configuración Panel Delivery
        Route::get('/customerTableDelyveryView', [TablesDeliveryController::class, 'index']);
        Route::get('/customerTableDelyveryRegistration', [TablesDeliveryController::class, 'viewTableForm']);
        Route::post('/customerTableDelyveryRegistration/insert', [TablesDeliveryController::class, 'store']);

        // ------------------------------------------------------
        // SECCIÓN 3: PEDIDOS DE DELIVERY (BOTONES ROJOS)
        // ------------------------------------------------------
        // He cambiado las URLs para que NO CHOCEN con las del salón
        Route::get('/tableOrderDetailsDelyvery/{id}', [TableCustomerOrderDeliveryController::class, 'index']);
        Route::get('/issueReceiptDelivery/{id}', [TableCustomerOrderDeliveryController::class, 'generateReceipt']);

        Route::post('/saveOrderDelivery/{table_id}', [TableCustomerOrderDeliveryController::class, 'saveOrder']);
        Route::post('/finalizeSaleDelivery/{table_id}', [TableCustomerOrderDeliveryController::class, 'finalizeSale']);

        // ------------------------------------------------------
        // SECCIÓN 4: MANTENIMIENTO (PRODUCTOS, CATEGORÍAS, USUARIOS)
        // ------------------------------------------------------
        // Productos
        Route::get('/productList', [ProductController::class, 'index']);
        Route::get('/productRegistration', [ProductController::class, 'insertProductView']);
        Route::post('/productRegistration', [ProductController::class, 'insertProduct']);
        Route::get('/products/{id}/edit', [ProductController::class, 'viewEdit'])->name('products.edit');
        Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}/delete', [ProductController::class, 'delete']);

        // Categorías
        Route::get('/categoryRegistration', [CategoryController::class, 'index']);
        Route::post('/categoryRegistration', [CategoryController::class, 'create']);
        Route::put('/categoryRegistration/{id}/update', [CategoryController::class, 'update']);
        Route::delete('/categoryRegistration/{id}', [CategoryController::class, 'delete']);

        // Personal
        Route::get('/staffList', [StaffController::class, 'index']);
        Route::get('/staffRegistration', [StaffController::class, 'viewForm']);
        Route::get('/staff/{id}/edit', [StaffController::class, 'viewEdit']);
        Route::post('/staff/store', [StaffController::class, 'store']);
        Route::put('/staff/update/{id}', [StaffController::class, 'update']);
        Route::patch('/staff/status/{id}', [StaffController::class, 'toggleStatus']);

        // Personal Reporte
        Route::get('/staffreport', [StaffReportController::class, 'index']);
        Route::post('/staffreport/pay/{id}', [StaffReportController::class, 'registerPayment']);

        // Pagos Adelantados (Advances)
        Route::get('/staffAdvanceRegistration', [StaffReportController::class, 'createAdvance']);
        Route::post('/staffAdvanceRegistration/store', [StaffReportController::class, 'storeAdvance']);

        // Faltas / Inasistencias
        Route::get('/staffAbsenceRegistration', [StaffReportController::class, 'createAbsence']);
        Route::post('/staffAbsenceRegistration/store', [StaffReportController::class, 'storeAbsence']);

        // Accesos y Credenciales (Usuarios)
        Route::get('/staff/{id}/credentials', [UserController::class, 'createCredentials']);
        Route::post('/staff/{id}/credentials', [UserController::class, 'storeCredentials']);





    });

});
