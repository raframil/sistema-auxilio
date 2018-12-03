<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('/dashboard', 'DashboardController@index');
    CRUD::resource('doenca', 'DoencaCrudController');
    CRUD::resource('tipo_funcionario', 'TipoFuncionarioCrudController');
    CRUD::resource('funcionarios', 'FuncionarioCrudController');
    CRUD::resource('tipo_situacao', 'TipoSituacaoCrudController');
    CRUD::resource('paciente', 'PacienteCrudController');
    CRUD::resource('cuidador', 'CuidadorCrudController');
    CRUD::resource('visita', 'VisitaCrudController');
    Route::get('/paciente_relatorio', 'PacienteRelatorioController@index');
   Route::post('/paciente_relatorio', 'PacienteRelatorioController@index');
}); 