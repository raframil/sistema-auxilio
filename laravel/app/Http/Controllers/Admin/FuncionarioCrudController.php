<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FuncionarioRequest as StoreRequest;
use App\Http\Requests\FuncionarioRequest as UpdateRequest;

use App\Models\Telefone;
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

        //$this->crud->enableDetailsRow();

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

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

        $this->crud->addColumn([
            'name' => 'id',         // The db column name
            'label' => "Telefone",  // Table column heading
            'type' => 'select',
            'entity' => 'telefones',       // the method that defines the relationship in your Model
            'attribute' => 'telefone',     // foreign key attribute that is shown to user
            'model' => "App\Models\Funcionario"
        ]);

        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text'
        ]);
        $this->crud->addField([
            'name' => 'cpf',
            'attributes' => [ // these attributes and their values will be passes to the HTML input
                "maxlength" => 11,
            ],
            'label' => "CPF",
            'type' => 'text'
        ]);

        /*$this->crud->addField([ 
            // Table
            'name' => 'telefone',
            'label' => 'Telefones',
            'type' => 'table',
            'entity_singular' => 'telefone', // used on the "Add X" button
            'columns' => [
                'telefone' => 'Número',
            ],
            'max' => 2, // maximum rows allowed in the table
            'min' => 1 // minimum rows allowed in the table
        ]);*/

        $this->crud->addField([
			'name' => 'funcao',                    // the column that contains the ID of that connected entity;
            'label' => "Função",
            'type' => 'select',     
            'entity' => 'tipoFuncionario',       // the method that defines the relationship in your Model
            'attribute' => 'nome',              // foreign key attribute that is shown to user
            'model' => "App\Models\TipoFuncionario"
        ]);
        /*
        $this->crud->addField([
            'name' => 'telefone1',
            'label' => "Telefone Residencial",
            'type' => 'text'
        ]);
        $this->crud->addField([
            'name' => 'telefone2',
            'label' => "Telefone Celular",
            'type' => 'text',
            'entity' => 'telefones',       // the method that defines the relationship in your Model
            'attribute' => 'telefone',     // foreign key attribute that is shown to user
            'model' => "App\Models\Funcionario"
        ]);*/

        

        // add asterisk for fields that are required in FuncionarioRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {   
        //salva os telefones do funcionario na tabela de telefones
        $telefones = $request->get('telefone');
        $telefoneArray = json_decode($telefones, true);

        $telefone_id_array = [];

        if ($telefones) {
            foreach($telefoneArray as $telefone) {
                $telefoneModel = new Telefone;
                $telefoneModel->telefone = $telefone['telefone'];
                $telefoneModel->save();
                $telefone_id_array[] = $telefoneModel->id;
            }
        }
        
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here

        //salva os ids dos telefones relacionando com o funcionaro na tabela funcionario_telefones
        $id_funcionario = $this->crud->entry->id;
        if ($telefones) {
            foreach($telefone_id_array as $key => $id) {
                $funcionarioTelefonesModel = new FuncionarioTelefone;
                $funcionarioTelefonesModel->funcionario_id = $id_funcionario;
                $funcionarioTelefonesModel->telefone_id = $telefone_id_array[$key];
                $funcionarioTelefonesModel->save();
            }
        }
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
