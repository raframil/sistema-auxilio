<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PacienteRelatorioController extends BaseController
{
    function index(Request $request) 
    {   
        if ($request->selectOrder) {
            $ordenacao = $request->selectOrder;
        }
        if ($request->qtd_result) {
            $qtd_result = $request->qtd_result;
        }
        $numeroPacientes = DB::table('pacientes')->count();
        $pacientesIdade = DB::table('pacientes')->select('data_nascimento')->get();

        $doencas = DB::table('doencas')->get();
        // Seleciona todas doencas e coloca seus respectivos nomes em um array
        $doencas_array = array();
        foreach($doencas as $key => $doenca) {
            $doencas_array[$key]['nome'] = $doenca->nome; 
            $doencas_array[$key]['doenca_id'] = $doenca->id; 
        }

        // Pega as 5 primeiras doencas mais recorrentes e salva em um vetor
        if((isset($ordenacao)) && isset($qtd_result)){
            $pacienteDoencas = DB::table('paciente_doencas')
            ->select((DB::raw('doenca_id')), DB::raw('count(*) as count'))
            ->groupBy('doenca_id')
            ->orderBy('count', $ordenacao)
            ->take($qtd_result)
            ->get();
        } else {
            $pacienteDoencas = DB::table('paciente_doencas')
            ->select((DB::raw('doenca_id')), DB::raw('count(*) as count'))
            ->groupBy('doenca_id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
        }
        $paciente_doencas_array = array();
        foreach ($pacienteDoencas as $key => $pacienteDoenca) {
            $paciente_doencas_array[$key]['doenca_id'] = $pacienteDoenca->doenca_id;
            $paciente_doencas_array[$key]['count'] = $pacienteDoenca->count;
        } 

        foreach ($pacienteDoencas as $key => $pacienteDoenca) {
            $id = $paciente_doencas_array[$key]['doenca_id'];
            $foundKey = array_search($id, array_column($doencas_array, 'doenca_id'));
            $paciente_doencas_array[$key]['nome'] = $doencas_array[$foundKey]['nome'];
        }

        // Seleciona as idades dos pacientes e salva em um array
        $pacientes_idade_array = array();
        foreach ($pacientesIdade as $pacienteIdade) {
            $dataNascimento = $pacienteIdade->data_nascimento;
            $_age = floor((time() - strtotime($dataNascimento)) / 31556926);
            $pacientes_idade_array[] = $_age; 
        }

        // Media das idades dos pacientes
        $sum_idade = 0;
        foreach ($pacientes_idade_array as $idade) {
            $sum_idade += $idade;
        }
        $mediaIdade = $sum_idade / count($pacientes_idade_array);

        return view('paciente_relatorio', [
            'numeroPacientes' => $numeroPacientes,
            'mediaIdade' => $mediaIdade,
            'doencas' => $doencas_array,
            'dadosDoencas' => $paciente_doencas_array,
        ]);        
    } 

}
