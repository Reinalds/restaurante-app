<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tipo', 'email', 'password', 'desempenho',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pedidos() {

        return $this->hasMany('App\Pedido');
    }

    public function quantidadePedidos() {

        return $this->hasMany('App\Pedido')->whereIdFuncionario1($this->id)->count();
    }
    
    public function scopeCozinheiro($query) {

        return $query->where('tipo', '=', 2);
    }

    public function scopeGarcom($query) {

        return $query->where('tipo', '=', 3);
    }

}
