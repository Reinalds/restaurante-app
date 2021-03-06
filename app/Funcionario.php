<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'nome', 'tipo'
    ];

    protected $hidden = [
        'idFuncionario'
    ];
}
