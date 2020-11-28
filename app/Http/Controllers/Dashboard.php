<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emprestimo;
use App\User;

/**
 * @author Gustavo Lidani
 *
 * Classe que carrega a aplicação
 */
class Dashboard extends Controller
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
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    // Captura o id do usuário logado
    $user_id = $request->user()->id;

    return view('dashboard', [
      // Lista dos objetos emprestados
      'emprestimos' => Emprestimo::where('emprestado_de', $user_id)
        // Mostrar primeiro os que ainda não foram devolvidos
        ->orderBy('devolvido', 'asc')
        // Mostrar primeiro os que ainda não foram devolvidos
        ->orderBy('devolvido_em', 'desc')
        // Depois mostrar os que estão mais atrasados na devolução combinada
        ->orderBy('devolucao_combinada', 'asc')
        // Captura a lista de empréstimos
        ->get(),

      // Lista dos outros usuários, para escolher para quem emprestar
      'usuarios' => User::where('id', '<>', $user_id)->get()
    ]);
  }

  /**
   * Tela de relatorio
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function relatorio(Request $request)
  {
    // Captura o id do usuário logado
    $user_id = $request->user()->id;

    return view('relatorio', [
      // Lista dos objetos emprestados
      'emprestimos' => Emprestimo::where('emprestado_de', $user_id)
        // Onde só tenha emprestimos pendentes
        ->where('devolvido', false)
        // Depois mostrar os que estão mais atrasados na devolução combinada
        ->orderBy('devolucao_combinada', 'asc')
        // Depois mostrar os mais recentes cadastrados
        ->orderBy('created_at', 'desc')
        // Captura a lista de empréstimos
        ->get(),

      // Lista dos outros usuários, para escolher para quem emprestar
      'usuarios' => User::where('id', '<>', $user_id)->get()
    ]);
  }
}
