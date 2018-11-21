<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PacienteEnderecoRequest as StoreRequest;
use App\Http\Requests\PacienteEnderecoRequest as UpdateRequest;

/**
 * Class PacienteEnderecoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PacienteEnderecoCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\PacienteEndereco');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/paciente_endereco');
        $this->crud->setEntityNameStrings('Endereço do Paciente', 'Endereços dos Pacientes');
        $this->crud->removeButton('create');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'paciente', 
            'label' => "Paciente", 
            'type' => 'select',
            'entity' => 'pacientes',       
            'attribute' => 'nome',              
            'model' => "App\Models\PacienteEndereco"
        ]);

        $this->crud->addColumn([
            'name' => 'cep', 
            'label' => "CEP", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'cep',              
            'model' => "App\Models\PacienteEndereco"
        ]);
        $this->crud->addColumn([
            'name' => 'rua', 
            'label' => "Rua", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'rua',              
            'model' => "App\Models\PacienteEndereco"
        ]);
        $this->crud->addColumn([
            'name' => 'bairro', 
            'label' => "Bairro", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'bairro',              
            'model' => "App\Models\PacienteEndereco"
        ]);
        $this->crud->addColumn([
            'name' => 'cidade', 
            'label' => "Cidade", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'cidade',              
            'model' => "App\Models\PacienteEndereco"
        ]);
        $this->crud->addColumn([
            'name' => 'uf', 
            'label' => "UF", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'uf',              
            'model' => "App\Models\PacienteEndereco"
        ]);
        $this->crud->addColumn([
            'name' => 'complemento', 
            'label' => "Complemento", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'complemento',              
            'model' => "App\Models\PacienteEndereco"
        ]);

        // add asterisk for fields that are required in PacienteEnderecoRequest
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
