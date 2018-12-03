<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

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
        'diagnostico',
        'endereco',
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function cuidadores()
    {
        return $this->hasMany('App\Models\Cuidador', 'paciente_id', 'id');
    }

    public function visitas()
    {
        return $this->hasMany('App\Models\Visita', 'paciente_id', 'id');
    }

    public function doencas()
    {
        // 1 paciente tem N doenças
        return $this->belongsToMany('App\Models\Doenca', 'paciente_doencas');
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
