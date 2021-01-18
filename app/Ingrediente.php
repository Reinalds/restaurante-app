<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{

    protected $table = 'ingrediente';

    protected $fillable = [
        'nome'
    ];

    protected $hidden = [
        'idIngrediente'
    ];

    public function pratos() {

        return $this->belongsToMany('App\Prato');
    }

}
