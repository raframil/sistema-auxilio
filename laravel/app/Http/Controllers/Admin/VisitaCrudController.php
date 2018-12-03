<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\VisitaRequest as StoreRequest;
use App\Http\Requests\VisitaRequest as UpdateRequest;

/**
 * Class VisitaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class VisitaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Visita');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/visita');
        $this->crud->setEntityNameStrings('Visita', 'Visitas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'data',
            'label' => "Data",
            'type' => 'text'
        ]);

        $this-> crud->addColumn([
            'name' => 'hora',
            'label' => "Hora",
            'type' => 'text'
        ]);

        $this->crud->addColumn([
			      'name' => 'paciente_id',
            'label' => "Paciente",
            'type' => 'select',
            'entity' => 'pacientes',
            'attribute' => 'nome',
            'model' => "App\Models\Visita"
        ]);

        $this->crud->addColumn([
            'name' => 'funcionario_id',
            'label' => "Funcionario",
            'type' => 'select',
            'entity' => 'funcionarios',
            'attribute' => 'nome',
            'model' => "App\Models\Visita"
        ]);

        $this->crud->addColumn([
            'name' => 'semanal',
            'label' => "Semanal",
            'type' => 'text'
        ]);

        $this-> crud->addColumn([
            'name' => 'mensal',
            'label' => "Mensal",
            'type' => 'text'
        ]);

        $this->crud->addField([
			      'name' => 'data',
            'label' => "Data",
            'type' => 'date'
        ]);

        $this->crud->addField([
            'name' => 'hora',
            'label' => "Hora",
            'type' => 'time'
        ]);

        $this->crud->addField([
			      'name' => 'paciente_id',
            'label' => "Paciente",
            'type' => 'select2',
            'entity' => 'pacientes',
            'attribute' => 'nome',
            'model' => "App\Models\Paciente"
        ]);

        $this->crud->addField([
			      'name' => 'funcionario_id',
            'label' => "Funcionario",
            'type' => 'select2',
            'entity' => 'funcionarios',
            'attribute' => 'nome',
            'model' => "App\Models\Funcionario"
        ]);

        $this->crud->addField([
			      'name' => 'semanal',
            'label' => "Semanal",
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'mensal',
            'label' => "Mensal",
            'type' => 'checkbox'
        ]);

        // add asterisk for fields that are required in VisitaRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
