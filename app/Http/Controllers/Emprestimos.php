<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @author Gustavo Lidani
 *
 * Classe controladora dos empréstimos
 */
class Emprestimos extends Controller
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
   * Função que faz a criação de um novo empréstimo
   */
  public function create(Request $request)
  {
    // Cria um novo empréstimo
    Emprestimo::create(
      // Faz a junção das listas
      array_merge(
        // Parâmetros da requisição
        $request->all(),
        // Lista de parâmetros
        [
          // Captura o usuário logado, dizendo que ele está emprestando
          'emprestado_de' => $request->user()->id
        ]
      )
    );

    // Retorna para a tela principal
    return redirect()->back();
  }

  /**
   * Função que marca um empréstimo como devolvido
   */
  public function devolver(Request $request)
  {

    // Captura o empréstimo que está sendo devolvido
    Emprestimo::find($request->id)
      // Faz o update do mesmo
      ->update([
        // Set devolvido como true
        'devolvido' => true,
        // E captura a data atual da devolução
        'devolvido_em' => Carbon::now()
      ]);

    // Retorna para a tela principal
    return redirect()->back();
  }
}
