<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FuncionarioRequest as StoreRequest;
use App\Http\Requests\FuncionarioRequest as UpdateRequest;

use App\Models\TelefoneFuncionario;
use App\Models\FuncionarioTelefone;

/**
 * Class FuncionarioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FuncionarioCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Funcionario');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/funcionarios');
        $this->crud->setEntityNameStrings('Funcionário', 'Funcionários');
        $this->crud->allowAccess('show');


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
            'name' => 'cpf', 
            'label' => "CPF", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'funcao', 
            'label' => "Função", 
            'type' => 'select',
            'entity' => 'tipoFuncionario',      
            'attribute' => 'nome',              
            'model' => "App\Models\Funcionario"
        ]);

        $this->crud->addColumn([
            'name' => 'telefone_principal',         
            'label' => "Telefone",  
            'type' => 'text',
        ]);

        /** cruds */

        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text',
            'tab' => 'Dados Básicos'
        ]);
        $this->crud->addField([
            'name' => 'cpf',
            'attributes' => [ 
                "maxlength" => 11,
            ],
            'label' => "CPF",
            'type' => 'text',
            'tab' => 'Dados Básicos'
        ]);

        $this->crud->addField([
			'name' => 'funcao',                    // the column that contains the ID of that connected entity;
            'label' => "Função",
            'type' => 'select',     
            'entity' => 'tipoFuncionario',      
            'attribute' => 'nome',              
            'model' => "App\Models\TipoFuncionario",
            'tab' => 'Dados Básicos'
        ]); 

        $this->crud->addField([
            'name' => 'telefone_principal', 
            'label' => "Telefone Principal", 
            'type' => 'text',
            'tab' => 'Telefone'
        ]);

        $this->crud->addField([
            'name' => 'telefone_secundario', 
            'label' => "Telefone Secundário", 
            'type' => 'text',
            'tab' => 'Telefone'
        ]);      

        // add asterisk for fields that are required in FuncionarioRequest
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

    public function showDetailsRow($id)
    {
        return "teste";
    }
}
