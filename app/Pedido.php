<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = "pedido";

    protected $fillable = [
        'status', 'pago', 'id_garcom', 'id_cliente', 'id_cozinheiro'
    ];

    public function cliente() {

        return $this->hasOne('App\Cliente');
    }

    public function funcionario() {

        return $this->hasMany('App\User');
    }

    public function pratos() {

        return $this->belongsToMany('App\Prato')->withPivot('quantidade');
    }
    
    public function scopePorDia($query, $dia) {

        return $query->whereDay('created_at', '=', $dia);
    }

    public function scopePorMes($query, $mes) {

        return $query->whereMonth('created_at', '=', $mes);
    }

    public function scopePorAno($query, $ano) {

        return $query->whereYear('created_at', '=', $ano);
    }
}
