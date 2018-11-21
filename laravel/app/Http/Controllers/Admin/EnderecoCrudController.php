<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EnderecoRequest as StoreRequest;
use App\Http\Requests\EnderecoRequest as UpdateRequest;

/**
 * Class EnderecoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EnderecoCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Endereco');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/enderecos');
        $this->crud->setEntityNameStrings('Endereço', 'Endereços');
        $this->crud->removeButton('create');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        /*$this->crud->addColumn([
            'name' => 'paciente', 
            'label' => "Paciente", 
            'type' => 'select',
            'entity' => 'enderecos',       
            'attribute' => 'nome',              
            'model' => "App\Models\Paciente"              
        ]);*/

        $this->crud->addColumn([
            'name' => 'cep', 
            'label' => "CEP", 
            'type' => 'text',            
        ]);
        $this->crud->addColumn([
            'name' => 'rua', 
            'label' => "Rua", 
            'type' => 'text',             
        ]);
        $this->crud->addColumn([
            'name' => 'bairro', 
            'label' => "Bairro", 
            'type' => 'text',             
        ]);
        $this->crud->addColumn([
            'name' => 'cidade', 
            'label' => "Cidade", 
            'type' => 'text',           
        ]);
        $this->crud->addColumn([
            'name' => 'uf', 
            'label' => "UF", 
            'type' => 'text',          
        ]);
        $this->crud->addColumn([
            'name' => 'complemento', 
            'label' => "Complemento", 
            'type' => 'text',              
        ]);

        /** Fields */
        $this->crud->addField([
            'name' => 'cep', 
            'label' => "CEP", 
            'type' => 'text',            
        ]);
        $this->crud->addField([
            'name' => 'rua', 
            'label' => "Rua", 
            'type' => 'text',             
        ]);
        $this->crud->addField([
            'name' => 'bairro', 
            'label' => "Bairro", 
            'type' => 'text',             
        ]);
        $this->crud->addField([
            'name' => 'cidade', 
            'label' => "Cidade", 
            'type' => 'text',           
        ]);
        $this->crud->addField([
            'name' => 'uf', 
            'label' => "UF", 
            'type' => 'text',          
        ]);
        $this->crud->addField([
            'name' => 'complemento', 
            'label' => "Complemento", 
            'type' => 'text',              
        ]);

        // add asterisk for fields that are required in EnderecoRequest
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
