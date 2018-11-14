<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DoencaRequest as StoreRequest;
use App\Http\Requests\DoencaRequest as UpdateRequest;

/**
 * Class DoencaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DoencaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Doenca');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/doenca');
        $this->crud->setEntityNameStrings('Doença', 'Doenças');

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
            'name' => 'cid', // The db column name
            'label' => "CID", // Table column heading
            'type' => 'text'
        ]);
        $this->crud->addColumn([
            'name' => 'descricao', // The db column name
            'label' => "Descrição", // Table column heading
            'type' => 'text'
        ]);

        $this->crud->addField([
			'name' => 'nome',
            'label' => "Nome",
            'type' => 'text'
        ]);
        $this->crud->addField([
			'name' => 'cid',
            'label' => "CID",
            'type' => 'text'
        ]);
        $this->crud->addField([
			'name' => 'descricao',
            'label' => "Descrição",
            'type' => 'text'
		]);


        // add asterisk for fields that are required in DoencaRequest
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
