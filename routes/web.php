<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;

use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    // Rutas para el módulo de usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas para el módulo de ventas
    Route::resource('ventas', VentaController::class);

    Route::resource('reportes', ReporteController::class);
    
    Route::get('/reporte/fecha', function() {
        return Inertia::render('Reportes/ReporteFecha', [
            'ventas' => \App\Models\Venta::all()
        ]);
    });
    Route::resource('reportes', ReporteController::class);
    Route::resource('/reportes/fecha', ReporteController::class);

    Route::get('/pdf', function (\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        if ($request->filled('fechaInicio')) {
            $query->whereDate('fecha_registro', '>=', $request->fechaInicio);
        }
        if ($request->filled('fechaFin')) {
            $query->whereDate('fecha_registro', '<=', $request->fechaFin);
        }
        $ventas = $query->orderBy('fecha_registro', 'desc')->get();
        $total = $ventas->sum('total');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf', compact('ventas', 'total'));
        return $pdf->stream('reporte_ventas.pdf');
    })->name('reportes.pdf');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';