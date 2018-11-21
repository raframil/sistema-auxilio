<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CuidadorRequest as StoreRequest;
use App\Http\Requests\CuidadorRequest as UpdateRequest;

/**
 * Class CuidadorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CuidadorCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Cuidador');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/cuidador');
        $this->crud->setEntityNameStrings('Cuidador', 'Cuidadores');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'nome', 
            'label' => "Nome",
            'type' => 'text'
        ]);

        $this->crud->addColumn([
			'name' => 'id',                   
            'label' => "Paciente",
            'type' => 'select',     
            'entity' => 'pacientes',       
            'attribute' => 'nome',              
            'model' => "App\Models\Cuidador"
        ]); 

        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text'
        ]);
        $this->crud->addField([
			'name' => 'paciente_id',                    
            'label' => "Paciente",
            'type' => 'select2',     
            'entity' => 'pacientes',       
            'attribute' => 'nome',              
            'model' => "App\Models\Paciente"
        ]);   

        // add asterisk for fields that are required in CuidadorRequest
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
