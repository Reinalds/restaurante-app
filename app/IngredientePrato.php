<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientePrato extends Model
{

    protected $table = 'ingrediente_prato';
    
    protected $fillable = [
    ];

    protected $hidden = [
        'idingrediente', 'idPrato'
    ];
}
