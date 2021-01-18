<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    protected $table = 'prato';

    protected $fillable = [
        'nome', 'preco'
    ];

    // private $hidden = [
    //     'idPrato'
    // ];

    public function ingredientes() {

        return $this->belongsToMany('App\Ingrediente')->withPivot('ingrediente_id', 'prato_id', 'quantidade');
    }

}
