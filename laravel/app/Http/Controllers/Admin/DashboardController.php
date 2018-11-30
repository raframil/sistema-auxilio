<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{


    function index() 
    {
        $numeroPacientes = DB::table('pacientes')->count();
        $numeroFuncionarios = DB::table('funcionarios')->count();
        $pacientesIdade = DB::table('pacientes')->select('data_nascimento')->get();
              
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



        return view('dashboard', [
            'numeroPacientes' => $numeroPacientes,
            'numeroFuncionarios' => $numeroFuncionarios,
            'mediaIdade' => $mediaIdade
        ]);

        
    } 
}
