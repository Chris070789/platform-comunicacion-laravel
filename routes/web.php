<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocenteCursoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\UnidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCursoController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\AlumnoBibliotecaController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\StageController;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:alumno'])->prefix('alumno')->as('alumno.')->group(function () {
    Route::get('/cursos', [AlumnoController::class, 'cursos'])->name('cursos.index');

    Route::get('/cursos/{curso}', [AlumnoController::class, 'show'])
        ->name('cursos.show');

    Route::get('/calificaciones', [AlumnoController::class, 'calificaciones'])->name('calificaciones');
});

Route::middleware(['auth', 'role:docente'])->prefix('docente')->as('docente.')->group(function () {
    Route::get('/cursos', [DocenteController::class, 'cursos'])->name('cursos');
    Route::get('/alumnos', [DocenteController::class, 'alumnos'])->name('alumnos');
    Route::post('/gestion-curso/unidades', [UnidadController::class, 'store'])->name('unidad.store');
    Route::delete('/gestion-curso/unidades/{id}', [UnidadController::class, 'destroy'])->name('unidad.destroy');
});

// Agrupamos por auth y rol admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/usuarios', [AdminController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/nuevo', [AdminController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [AdminController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{user}/editar', [AdminController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}', [AdminController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [AdminController::class, 'destroy'])->name('usuarios.destroy');
});

Route::middleware(['auth', 'role:docente'])->prefix('docente')->as('docente.')->group(function () {
    // Gestionar MI curso
    Route::get('/curso/gestion', [DocenteCursoController::class, 'index'])->name('curso.gestion');
    Route::resource('materiales', MaterialController::class)->except(['show'])->parameters(['materiales' => 'material']);
    //Route::resource('unidades', UnidadController::class)->except(['show']);
    //Route::resource('unidades.temas', TemaController::class)->except(['show']);
    Route::resource('cronograma', CronogramaController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('cursos', AdminCursoController::class)->except(['show']);
});

Route::post('/materiales', [MaterialController::class, 'store'])->name('materiales.store');

Route::middleware(['auth', 'verified', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')          // ← importante: todos los nombres empiezan con "docente."
    ->group(function () {

        // Resource anidado:  docente/unidades/{unidad}/temas/...
        Route::resource('unidades.temas', TemaController::class)
            ->parameters([       // ← cambia SOLO el parámetro del padre
                'unidades' => 'unidad'   // ahora la URL tendrá {unidad} en vez de {unidade}
            ]);
    });

Route::middleware(['auth', 'verified', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {
        Route::resource('unidades', UnidadController::class)
            ->parameters(['unidades' => 'unidad']); // ← cambia {unidade} → {unidad}
    });

Route::prefix('docente')
    ->name('docente.')          // <- produce docente.xxx
    ->middleware(['auth', 'role:docente'])
    ->group(function () {
        Route::resource('biblioteca', BibliotecaController::class)
            ->only(['index', 'create', 'store', 'show', 'destroy'])
            ->names([            // opcional: fuerza los nombres
                'index'   => 'biblioteca.index',
                'create'  => 'biblioteca.create',
                'store'   => 'biblioteca.store',
                'show'    => 'biblioteca.show',
                'destroy' => 'biblioteca.destroy',
            ]);
    });

Route::middleware(['auth', 'role:alumno'])
    ->prefix('alumno')
    ->as('alumno.')
    ->group(function () {
        Route::get('biblioteca', [AlumnoBibliotecaController::class, 'index'])->name('biblioteca.index');
        Route::get('biblioteca/{biblioteca}', [AlumnoBibliotecaController::class, 'show'])->name('biblioteca.show');
    });

Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->group(function () {
        Route::resource('materiales', MaterialController::class)
            ->parameters(['materiales' => 'material']); // ← sin names(), sin más
    });

// Rutas de docente para gestionar talleres
Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {
        // Talleres
        //Route::get('/talleres', [WorkshopController::class, 'index'])->name('docente.taller.index');
        Route::get('/taller/create', [WorkshopController::class, 'create'])->name('taller.create');
        Route::post('/taller', [WorkshopController::class, 'store'])->name('taller.store');
        Route::get('/taller/{workshop}/edit', [WorkshopController::class, 'edit'])->name('taller.edit');
        Route::put('/taller/{workshop}', [WorkshopController::class, 'update'])->name('taller.update');
        Route::delete('/taller/{workshop}', [WorkshopController::class, 'destroy'])->name('taller.destroy');


        // Ejercicios (stages)
        Route::get('/taller/{workshop}/stages', [StageController::class, 'index'])->name('taller.stages');
        Route::get('/taller/{workshop}/stages/create', [StageController::class, 'create'])->name('stage.create');
       // Route::post('/taller/{workshop}/stages', [StageController::class, 'store'])->name('stage.store');
        Route::get('/stage/{stage}/edit', [StageController::class, 'edit'])->name('stage.edit');
        Route::put('/stage/{stage}', [StageController::class, 'update'])->name('stage.update');
        Route::delete('/stage/{stage}', [StageController::class, 'destroy'])->name('stage.destroy');
    });

Route::get('/talleres', [WorkshopController::class, 'index'])
    ->name('docente.taller.index');

Route::middleware(['auth', 'verified'])->prefix('docente')->name('docente.')->group(function () {
    Route::post('/workshops/{workshop}/stages', [StageController::class, 'store'])
        ->name('stages.store');
});

require __DIR__ . '/auth.php';
