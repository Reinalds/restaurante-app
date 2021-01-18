<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PratoPedido extends Model
{
    protected $table = "pedido_prato";

    protected $fillable = [
        'quantidade'
    ];

    protected $hidden = [
        'id_pedido', 'id_prato'
    ];

    public function prato() {

        return $this->hasOne('App\Prato');
    }

    public function pedido() {

        return $this->hasOne('App\Pedido');
    }
}
