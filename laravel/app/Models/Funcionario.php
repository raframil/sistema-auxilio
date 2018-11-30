<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class Funcionario extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'funcionarios';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'nome',
        'cpf',
        'funcao',
        'telefone_principal',
        'telefone_secundario'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function editTelefone($crud = false)
    {
        $telefone_id = DB::table('telefones_funcionario')->where('funcionario_id', $this->id)->first();
        return '<a class="btn btn-xs btn-default" target="_blank" href="funcionario_telefones/'.$telefone_id->id.'/edit" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-phone"></i> Editar Telefone</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Retorna o tipo de funcionario.
     */
    public function tipoFuncionario()
    {
        return $this->hasOne('App\Models\TipoFuncionario', 'id', 'funcao');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
