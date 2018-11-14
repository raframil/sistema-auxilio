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

        return view('dashboard', [
            'numeroPacientes' => $numeroPacientes,
            'numeroFuncionarios' => $numeroFuncionarios
            ]);
    }

    
}
