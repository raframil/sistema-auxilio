<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Paciente extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pacientes';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'nome',
        'data_nascimento',
        'data_inclusao',
        'cartao_sus',
        'prontuario',
        'diagnostico'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function telefones()
    {
        return $this->hasManyThrough(
            'App\Models\Telefone',
            'App\Models\PacienteTelefone',
            'paciente_id',
            'id',
            'id',
            'telefone_id'
        );
    }

    public function enderecos()
    {
        return $this->hasManyThrough(
            'App\Models\Endereco',
            'App\Models\PacienteEndereco',
            'paciente_id',
            'id',
            'id',
            'endereco_id'
        );
    }
    
    public function cuidadores() 
    {
        return $this->hasMany('App\Models\Cuidador', 'paciente_id', 'id');
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
