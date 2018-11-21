<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PacienteRequest as StoreRequest;
use App\Http\Requests\PacienteRequest as UpdateRequest;

use App\Models\Telefone;
use App\Models\PacienteTelefone;

use App\Models\Endereco;
use App\Models\PacienteEndereco;

use Illuminate\Support\Facades\DB;

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
        $this->crud->enableDetailsRow();

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
            'name' => 'diagnostico', 
            'label' => "Diagnóstico Inicial", 
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'id',        
            'label' => "Telefone",  
            'type' => 'select',
            'entity' => 'telefones',     
            'attribute' => 'telefone',     
            'model' => "App\Models\Paciente"
        ]);

        /** ADD FIELD */
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
            'name' => 'diagnostico', 
            'label' => "Diagnóstico Inicial", 
            'type' => 'text',
            'tab' => 'Dados do Paciente'
        ]);

        $this->crud->addField([ 
            // Table
            'name' => 'telefone',
            'label' => 'Telefones',
            'type' => 'table',
            'entity_singular' => 'telefone', // used on the "Add X" button
            'columns' => [
                'telefone' => 'Número',
            ],
            'max' => 2, // maximum rows allowed in the table
            'min' => 0,
            'tab' => 'Telefones'
        ], 'create');

        $this->crud->addField([
            'name' => 'cep', 
            'label' => "CEP", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');
        $this->crud->addField([
            'name' => 'rua', 
            'label' => "Rua", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');
        $this->crud->addField([
            'name' => 'bairro', 
            'label' => "Bairro", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');
        $this->crud->addField([
            'name' => 'cidade', 
            'label' => "Cidade", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');
        $this->crud->addField([
            'name' => 'uf', 
            'label' => "Estado (UF)", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');
        $this->crud->addField([
            'name' => 'complemento', 
            'label' => "Complemento", 
            'type' => 'text',
            'tab' => 'Endereço'
        ], 'create');

        // add asterisk for fields that are required in PacienteRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {   
        $erros = '<p>Um erro ocorreu: </p><ul></ul>';
        $erroEndereco = true;
        $erroTelefone = true;
        // Salva os telefones do paciente na tabela de telefones
        $telefones = $request->get('telefone');
        $telefoneArray = json_decode($telefones, true);

        $telefone_id_array = [];

        if ($telefones) {
            $erroTelefone = false;
            foreach($telefoneArray as $telefone) {
                $telefoneModel = new Telefone;
                $telefoneModel->telefone = $telefone['telefone'];
                $telefoneModel->save();
                $telefone_id_array[] = $telefoneModel->id;
            }
        } else {
            $erroTelefone = true;
            $erros .= "<li>Preencha pelo menos um telefone</li>";
            \Alert::error(trans($erros))->flash();
            return back()->withInput();
        }

        $cep = $request->get('cep');
        $rua = $request->get('rua');
        $bairro = $request->get('bairro');
        $cidade = $request->get('cidade');
        $uf = $request->get('uf');
        $complemento = $request->get('complemento');

        if (isset($cep) && isset($rua) && isset($bairro) && isset($cidade) && isset($uf) && isset($complemento)) {
            $cep = preg_replace("/[^0-9]/", "", $cep);
            $erroEndereco = false;

            if (strlen($uf) != 2 ) {
                $erroEndereco = true;
                $erros .= "<li>O campo estado excedeu o limite de 2 caracteres</li>";
            }
        }

        if (!isset($cep) || !isset($rua) || !isset($bairro) || !isset($cidade) || !isset($uf)) {
            $erroEndereco = true;
            if (!isset($cep)) {
                $erros .= "<li>Preencha o CEP</li>";
            } 
            if (!isset($rua)) {
                $erros .= "<li>Preencha a Rua</li>";
            }
            if (!isset($bairro)) {
                $erros .= "<li>Preencha o Bairro</li>";
            }
            if (!isset($cidade)) {
                $erros .= "<li>Preencha a Cidade</li>";
            }
            if (!isset($uf)) {
                $erros .= "<li>Preencha o Estado</li>";
            }
        }

        if ($erroEndereco == false) {
            $enderecoModel = new Endereco;
            $enderecoModel->cep = $cep;
            $enderecoModel->rua = $rua;
            $enderecoModel->bairro = $bairro;
            $enderecoModel->cidade = $cidade;
            $enderecoModel->uf = $uf;
            $enderecoModel->complemento = $complemento;
            $enderecoModel->save();
            $endereco_id = $enderecoModel->id;
        } else {
            \Alert::error(trans($erros))->flash();
            return back()->withInput();
        }

        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here

        // Salva os ids dos telefones relacionando com o paciente na tabela paciente_telefones
        $id_paciente = $this->crud->entry->id;
        if ($telefones) {
            foreach($telefone_id_array as $key => $id) {
                $pacienteTelefonesModel = new PacienteTelefone;
                $pacienteTelefonesModel->paciente_id = $id_paciente;
                $pacienteTelefonesModel->telefone_id = $telefone_id_array[$key];
                $pacienteTelefonesModel->save();
            }
        } 
        
        if($erroEndereco == false) {
            $pacienteEnderecoModel = new PacienteEndereco;
            $pacienteEnderecoModel->paciente_id = $id_paciente;
            $pacienteEnderecoModel->endereco_id = $endereco_id;
            $pacienteEnderecoModel->save();
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
        $enderecosIds = DB::table('paciente_enderecos')->select('endereco_id')->where('paciente_id', $id)->get();
        foreach ($enderecosIds as $key) {
            $enderecoID = $key->endereco_id;
        } 

        $telPacientesIds = DB::table('paciente_telefones')->select('telefone_id')->where('paciente_id', $id)->first();

        $tels = DB::table('telefones')->where('id', $telPacientesIds->telefone_id)->first();

        $enderecos = DB::table('enderecos')->where('id', $enderecoID)->get();
        echo "<p><strong>-- Endereço -- </strong> </p>";
        foreach ($enderecos as $endereco) {
            echo "<p><strong>CEP:</strong> ".$endereco->cep."</p>";
            echo "<p><strong>Logradouro:</strong> ".$endereco->rua."</p>";
            echo "<p><strong>Bairro:</strong> ".$endereco->bairro."</p>";
            echo "<p><strong>Cidade:</strong> ".$endereco->cidade."</p>";
            echo "<p><strong>UF:</strong> ".$endereco->uf."</p>";
            echo "<p><strong>Complemeto:</strong> ".$endereco->complemento."</p>";
        }
        echo '<a href="/admin/enderecos/'.$enderecoID.'/edit" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Editar Endereço</a>';

        echo "<h4>Telefone Principal: ".$tels->telefone."</h4>";
        echo '<a href="/admin/telefones/'.$tels->id.'/edit" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Editar Telefone</a>';
        
    }
}
