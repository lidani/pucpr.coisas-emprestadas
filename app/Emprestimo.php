<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Gustavo Lidani
 *
 * Classe Modelo que representa um objeto emprestado
 */
class Emprestimo extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'objeto',
    'contato',
    'devolucao_combinada',
    'emprestado_de',
    'emprestado_para',
    'devolvido',
    'devolvido_em'
  ];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['devolucao_combinada', 'created_at', 'updated_at', 'devolvido_em'];

  /**
   * Relação para qual usuário foi emprestado o item
   */
  public function para()
  {
    // Retorna a relação
    return $this->hasOne(\App\User::class, 'id', 'emprestado_para');
  }
}
