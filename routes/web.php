<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\CorrespondenciaController;
use App\Http\Controllers\DerivacorrespondenciaController;
use App\Models\Derivacorrespondencia;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;



use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tramites/buscar', [CorrespondenciaController::class, 'mostrarFormulario'])->name('tramites.formulario');
Route::get('/tramites/resultados', [CorrespondenciaController::class, 'buscar'])->name('tramite.buscar');

Route::get('/', function () {
    return view('welcome');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(CorrespondenciaController::class)->group(function () {
        Route::middleware('permission:ver correspondencia')->get('correspondencia', 'index')->name('correspondencia.index');

        Route::middleware('permission:registrar correspondencia')->get('correspondencia/registrar', 'registrar')->name('correspondencia.registrar');
        Route::middleware('permission:registrar correspondencia')->post('correspondencia', 'store')->name('correspondencia.store');

        Route::middleware('permission:ver detalles de correspondencia')->get('correspondencia/{nombre}', 'mostrar')->name('correspondencia.mostrar');
        Route::middleware('permission:ver detalles de correspondencia')->get('correspondencia/{id}', 'show')->name('correspondencia.show');

        Route::middleware('permission:editar correspondencia')->get('correspondencia/{correspondencia}/editar', 'editar')->name('correspondencia.editar');
        Route::middleware('permission:editar correspondencia')->put('correspondencia/{correspondencia}', 'update')->name('correspondencia.update');

        Route::middleware('permission:eliminar correspondencia')->delete('correspondencia/{id}', 'borrar')->name('correspondencia.borrar');

        Route::get('/correspondencia/confirmacion/{id}',  'confirmacion')->name('correspondencia.confirmacion');

      
        Route::get('/correspondencia/{id}/imprimir-hoja-ruta', 'generarHojaIndividual')->name('correspondencia.imprimir_hoja_ruta');

        Route::get('/tramites/interno', 'formularioInterno')->name('tramites.formularioInterno');
        Route::post('/tramites/buscar-interno', 'buscarInterno')->name('tramites.buscarInterno');

        

    });

    Route::controller(DerivaCorrespondenciaController::class)->group(function () {
        Route::middleware('permission:derivar correspondencia')->get('derivacion/{id}', 'index')->name('derivacion.index');
        Route::middleware('permission:derivar correspondencia')->post('derivacion/{id}', 'store')->name('derivacion.store');
        Route::middleware('permission:derivar correspondencia')->get('/tramite/{id}', 'verTramite')->name('tramite.ver');
        Route::middleware('permission:derivar correspondencia')->post('/derivacion/{id}/recibir')->name('derivacorrespondencia.recibir');
        Route::middleware('permission:derivar correspondencia')->post('/derivacion/{id}/concluir')->name('derivacorrespondencia.concluir');
    });

    Route::controller(TramiteController::class)->group(function () {
        Route::middleware('permission:ver trámites recibidos')->get('/tramites/recibidos', 'recibidos')->name('tramites.recibidos');
        Route::middleware('permission:ver trámites pendientes')->get('/tramites/pendientes', 'pendientes')->name('tramites.pendientes');
        Route::middleware('permission:ver trámites conluidos')->get('/tramites/despachados', 'despachados')->name('tramites.despachados');
        Route::middleware('permission:ver mis trámites')->get('/bandeja', 'bandejaEntrada')->name('bandeja.entrada');
        Route::middleware('permission:ver mis trámites')->post('/tramites/accion', 'registrarAccion')->name('tramites.accion');
        Route::middleware('permission:ver por referencia')->get('/buscar-referencia', 'formularioBusquedaReferencia')->name('tramites.buscarPorReferenciaForm');
        Route::middleware('permission:ver por referencia')->get('/buscar-por-referencia',  'buscarPorReferencia')->name('tramites.buscarPorReferencia');
    });


    // Vista con botón
    Route::get('/alertas/verificar', function () {
        return view('alertas.verificar');
    })->name('alertas.verificar');

    // // Acción que ejecuta la verificación
    // Route::post('/alertas/verificar-ejecucion', [AlertaController::class, 'verificarRetenciones'])
    //     ->name('alertas.verificar.ejecucion');

    Route::controller(ReporteController::class)->group(function () {
        Route::middleware('permission:generar reportes')->get('/reportes',  'menu')->name('reportes.menu');

        Route::middleware('permission:generar reportes')->get('/reportes/general',  'index')->name('reportes.general');
        Route::middleware('permission:generar reportes')->post('/reportes/generar',  'generar')->name('reportes.generar');



        Route::middleware('permission:generar reportes')->get('/reportes/libro', 'libroCorrespondencia')->name('reportes.libro');
        Route::middleware('permission:generar reportes')->post('/reportes/libro/generar', 'generarLibro')->name('reportes.libro.generar');

        // Route::middleware('permission:generar reportes')->get('/reportes/hoja', 'hojaRuta')->name('reportes.hoja');
        // Route::middleware('permission:generar reportes')->post('/reportes/hoja/generar',  'generarHoja')->name('reportes.hoja.generar');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::put('usuarios/{id}/cambiar-rol', [UserController::class, 'cambiarRol'])->name('usuarios.cambiarRol');
    Route::resource('roles', App\Http\Controllers\RolController::class)->except(['show']);
    Route::get('/roles/{role}/permisos', [App\Http\Controllers\RolController::class, 'editPermisos'])->name('roles.permisos.edit');
    Route::put('/roles/{role}/permisos', [App\Http\Controllers\RolController::class, 'updatePermisos'])->name('roles.permisos.update');
});
