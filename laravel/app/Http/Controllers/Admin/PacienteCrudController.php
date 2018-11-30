<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PacienteRequest as StoreRequest;
use App\Http\Requests\PacienteRequest as UpdateRequest;

/**
 * Class PacienteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PacienteCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Paciente');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/paciente');
        $this->crud->setEntityNameStrings('Paciente', 'Pacientes');
        $this->crud->allowAccess('show');
        $this->crud->enableExportButtons();

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
            'name' => 'data_nascimento', 
            'label' => "Data de Nascimento", 
            'type' => 'date'
        ]);

        $this->crud->addColumn([
            'name' => 'data_inclusao', 
            'label' => "Data de Inclusão", 
            'type' => 'date'
        ]);

        $this->crud->addColumn([
            'name' => 'cartao_sus', 
            'label' => "Cartão SUS", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'prontuario', 
            'label' => "Prontuário", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => "endereco->name",
            'label' => 'Endereço',
            'type' => 'array',
        ]);

        $this->crud->addColumn([
            'name' => 'telefone_principal', 
            'label' => "Telefone", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'diagnostico', 
            'label' => "Diagnóstico Inicial", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'label' => "Doenças",
            'type' => 'select',
            'name' => 'id',
            'entity' => 'doencas',
            'attribute' => 'nome',
            'model' => "App\Models\Paciente"
        ]);

        /** CRUDs FIELD */
        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
			'name' => 'data_nascimento',
            'label' => "Data de Nascimento",
            'type' => 'date',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
			'name' => 'data_inclusao',
            'label' => "Data de Inclusão",
            'type' => 'date',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
            'name' => 'cartao_sus', 
            'label' => "Cartão SUS", 
            'type' => 'text',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
            'name' => 'prontuario', 
            'label' => "Prontuário", 
            'type' => 'text',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
            // Address
            'name' => 'endereco',
            'label' => 'Endereço',
            'type' => 'address',
            // optional
            'store_as_json' => true,
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
            'name' => 'diagnostico', 
            'label' => "Diagnóstico Inicial", 
            'type' => 'text',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([
			'label' => "Doenças",
		    'type' => 'select2_multiple',
		    'name' => 'doencas', // the db column for the foreign key
		    'entity' => 'doencas', // the method that defines the relationship in your Model
		    'attribute' => 'nome', // foreign key attribute that is shown to user
		    'model' => "App\Models\Doenca", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'tab' => 'Dados do Paciente'
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

        // add asterisk for fields that are required in PacienteRequest
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
