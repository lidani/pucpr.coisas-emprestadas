<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * @author Gustavo Lidani
 *
 * Classe controladora dos usuários
 */
class Users extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // Aplica o middleware de autenticação
    $this->middleware('auth');
  }

  /**
   * Mostra a tela de perfil
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    // Retorna a tela com o usuário
    return view('perfil', ['user' => $request->user()]);
  }


  /**
   * Função que altera as informações do usuário
   */
  public function alterar(Request $request)
  {
    // Captura os dados
    $data = array_filter($request->only(['name', 'email', 'password']));

    // Se o usuário tentou mudar a senha
    if (array_key_exists('password', $data))
      // Faz um hash com a nova senha enviada
      $data['password'] = Hash::make($data['password']);

    // Atualiza o usuário
    $request->user()->update($data);

    // Volta para a tela de perfil
    return redirect()->back();
  }
}
