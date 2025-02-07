<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JuzgadoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkSpaceController;
use App\Http\Controllers\TaskPriorityController;
use App\Http\Controllers\MedioContactoController;
use App\Http\Controllers\ReportFacturableController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    # Roles
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RolController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RolController::class, 'update'])->name('roles.update');
    Route::get('/roles/{role}', [RolController::class, 'destroy'])->name('roles.destroy');

    # Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/usuarios/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    # Juzgados
    Route::get('/juzgados', [JuzgadoController::class, 'index'])->name('juzgado.index');
    Route::get('/juzgados/create', [JuzgadoController::class, 'create'])->name('juzgado.create');
    Route::post('/juzgados/store', [JuzgadoController::class, 'store'])->name('juzgado.store');
    Route::get('/juzgados/{id}/edit', [JuzgadoController::class, 'edit'])->name('juzgado.edit');
    Route::put('/juzgados/{id}/update', [JuzgadoController::class, 'update'])->name('juzgado.update');
    Route::get('/juzgados/{id}/destroy', [JuzgadoController::class, 'destroy'])->name('juzgado.destroy');

    # Materias
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias/create', [MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias/store', [MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])->name('materias.edit');
    Route::put('/materias/{id}/update', [MateriaController::class, 'update'])->name('materias.update');
    Route::get('/materias/{id}/destroy', [MateriaController::class, 'destroy'])->name('materias.destroy');

    # medios de contacto
    Route::get('/medios-contacto', [MedioContactoController::class, 'index'])->name('medios-contacto.index');
    Route::get('/medios-contacto/create', [MedioContactoController::class, 'create'])->name('medios-contacto.create');
    Route::post('/medios-contacto/store', [MedioContactoController::class, 'store'])->name('medios-contacto.store');
    Route::get('/medios-contacto/{id}/edit', [MedioContactoController::class, 'edit'])->name('medios-contacto.edit');
    Route::put('/medios-contacto/{id}/update', [MedioContactoController::class, 'update'])->name('medios-contacto.update');
    Route::get('/medios-contacto/{id}/destroy', [MedioContactoController::class, 'destroy'])->name('medios-contacto.destroy');

    # Clientes
    Route::get('/clientes', [ClientController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClientController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/store', [ClientController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}/edit', [ClientController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}/update', [ClientController::class, 'update'])->name('clientes.update');
    Route::get('/clientes/{id}/destroy', [ClientController::class, 'destroy'])->name('clientes.destroy');

    # gestiones
    Route::get('/gestiones', [WorkSpaceController::class, 'index'])->name('gestiones.index');
    Route::get('/gestiones/create', [WorkSpaceController::class, 'create'])->name('gestiones.create');
    Route::post('/gestiones/store', [WorkSpaceController::class, 'store'])->name('gestiones.store');
    Route::get('/gestiones/{id}', [WorkSpaceController::class, 'show'])->name('gestiones.show');
    Route::get('/gestiones/{id}/show-client', [WorkSpaceController::class, 'showclient'])->name('gestiones.showclient');
    Route::get('/gestiones/{id}/edit', [WorkSpaceController::class, 'edit'])->name('gestiones.edit');
    Route::put('/gestiones/{id}/update', [WorkSpaceController::class, 'update'])->name('gestiones.update');
    Route::get('/gestiones/{id}/destroy', [WorkSpaceController::class, 'destroy'])->name('gestiones.destroy');

    # tablero kamban
    # acciones en tareas
    Route::get('/kambanjson/{id}', [WorkSpaceController::class, 'kambanJson'])->name('kambanjson');
    Route::post('/kamban/store-item', [WorkSpaceController::class, 'storeitem'])->name('kamban.storeitem');
    Route::get('/kamban/{id}/show-item', [WorkSpaceController::class, 'showitem'])->name('kamban.showitem');
    Route::post('/kamban/update-item', [WorkSpaceController::class, 'updateitem'])->name('kamban.updateitem');
    Route::get('/kamban/{workspace_id}/{id}/delete-item', [WorkSpaceController::class, 'deleteitem'])->name('kamban.deleteitem');
    # acciones en tablero
    Route::post('/kamban/{workspace}/store-board', [WorkSpaceController::class, 'storeboard'])->name('kamban.storeboard');
    Route::post('/kamban/rename-board', [WorkSpaceController::class, 'renameboard'])->name('kamban.renameboard');
    Route::post('/kamban/delete-board', [WorkSpaceController::class, 'deleteboard'])->name('kamban.deleteboard');
    Route::post('/kamban/move-item-board', [WorkSpaceController::class, 'moveitem'])->name('kamban.moveitem');

    # Task por prioridad
    Route::get('/tareas-por-prioridad', [TaskPriorityController::class, 'index'])->name('task-priority.index');
    Route::get('/tareas-por-prioridad/json', [TaskPriorityController::class, 'json'])->name('task-priority.json');

    #Report
    Route::get('/reporte-facturable', [ReportFacturableController::class, 'index'])->name('report.index');
});

Route::get('comandos', function () {
 Artisan::call('optimize');
 Artisan::call('view:clear');
 Artisan::call('cache:clear');
 Artisan::call('route:clear');
 Artisan::call('config:clear');
 Artisan::call('config:cache');
 Artisan::call('view:cache');
 Artisan::call('route:cache');

 return 'Comandos ejecutados con éxitos';
});

require __DIR__.'/auth.php';
