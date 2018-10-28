<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FuncionarioRequest as StoreRequest;
use App\Http\Requests\FuncionarioRequest as UpdateRequest;

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
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/funcionario');
        $this->crud->setEntityNameStrings('funcionário', 'funcionários');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->addColumn([
            'name' => 'nome', // The db column name
            'label' => "Nome", // Table column heading
            'type' => 'text'
        ]);
        $this->crud->addColumn([
            'name' => 'cpf', // The db column name
            'label' => "CPF", // Table column heading
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'funcao', // The db column name
            'label' => "Função", // Table column heading
            'type' => 'select',
            'entity' => 'tipoFuncionario',       // the method that defines the relationship in your Model
            'attribute' => 'nome',              // foreign key attribute that is shown to user
            'model' => "App\Models\Funcionario"
        ]);


        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text'
        ]);
        $this->crud->addField([
			'name' => 'cpf',
            'label' => "CPF",
            'type' => 'text'
        ]);

        $this->crud->addField([
			'name' => 'funcao',                    // the column that contains the ID of that connected entity;
            'label' => "Função",
            'type' => 'select',     
            'entity' => 'tipoFuncionario',       // the method that defines the relationship in your Model
            'attribute' => 'nome',              // foreign key attribute that is shown to user
            'model' => "App\Models\TipoFuncionario"
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
}
