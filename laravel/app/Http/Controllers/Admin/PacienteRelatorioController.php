<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

class PacienteRelatorioController extends BaseController
{


    function index() 
    {
        $numeroPacientes = DB::table('pacientes')->count();
        $numeroFuncionarios = DB::table('funcionarios')->count();
        $pacientesIdade = DB::table('pacientes')->select('data_nascimento')->get();

        $doencas = DB::table('doencas')->get();
        
        // Pega as 5 primeiras doencas mais recorrentes e salva em um vetor
        $pacienteDoencas = DB::table('paciente_doencas')
        ->select((DB::raw('doenca_id')), DB::raw('count(*) as count'))
        ->groupBy('doenca_id')
        ->orderBy('count', 'desc')
        ->take(10)
        ->get();
        $paciente_doencas_array = array();
        //dd($pacienteDoencas);
        foreach ($pacienteDoencas as $key => $pacienteDoenca) {
            echo $pacienteDoenca->count;
            $paciente_doencas_array[$key]['nome'] = $doencas[$key]->nome;
            $paciente_doencas_array[$key]['count'] = $pacienteDoenca->count;
        } 
  
        // Seleciona todas doencas e coloca seus respectivos nomes em um array
        $doencas_array = array();
        foreach($doencas as $doenca) {
          $doencas_array[] = $doenca->nome; 
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
            'numeroFuncionarios' => $numeroFuncionarios,
            'mediaIdade' => $mediaIdade,
            'doencas' => $doencas_array,
            'contDoencas' => $paciente_doencas_array,
        ]);

        
    } 
}
