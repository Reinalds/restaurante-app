<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //PERMISSOES: 1 - Administrador;    2 - Cozinheiro;     3 - Garcom;

    public function index() {

        $usuarios = User::all();

        return view('administracao.index', ['usuarios' =>$usuarios]);
    }

    public function buscarUsuarios() {

        $usuarios = User::all();

        return view('administracao.busca', ['usuarios' =>$usuarios]);
    }

    public function desempenhoGeral() {

        $garcons = User::garcom()->get();

        $cozinheiros = User::cozinheiro()->get();

        return view('relatorios.relatorios', ['garcons' => $garcons,
                                              'cozinheiros' => $cozinheiros]);
    }

    public function desempenhoGarcom() {

        $garcons = User::garcom()->get();

        return view('relatorios.garcom', ['garcons' => $garcons]);
    }

    public function desempenhoCozinheiro() {
        
        $cozinheiros = User::cozinheiro()->get();

        return view('relatorios.cozinheiro', ['cozinheiros' => $cozinheiros]);
    }

    public function cadastrarUsuario(Request $request) {

        $nome = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $tipo = $request->input('tipo');

        $user = new User();

        $user->name = $nome;
        $user->email = $email;
        $user->password = $password;
        $user->tipo = $tipo;

        $user->save();

        return redirect()->route('administracao.index');
    }

    public function buscarUsuarioEdicao(Request $request) {

        $id = $request->id_usuario;

        $usuario = User::findOrFail($id);

        return view('administracao.editar', ['usuario' => $usuario]);
    }

    public function editarUsuario(Request $request) {

        $usuario = User::findOrFail($request->input('id'));

        if(!empty($request->input('name'))) {

            $usuario->name = $request->input('name');
        }

        if(!empty($request->input('email'))) {

            $usuario->email = $request->input('email');
        }

        if(!empty($request->input('tipo'))) {

            $usuario->tipo = $request->input('tipo');
        }

        $usuario->save();

        return redirect()->route('administracao.index');

    }

    public function excluirUsuario($id) {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('administracao.index');
    }

}
