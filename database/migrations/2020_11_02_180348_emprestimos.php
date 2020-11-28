<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Gustavo Lidani
 *
 * Classe que é responsável pelo create e drop da tabela de empréstimos
 */
class Emprestimos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // Cria a tabela
    Schema::create('emprestimos', function (Blueprint $table) {
      // Identificador único do empréstimo
      $table->id();
      // Qual objeto de empréstimo
      $table->string('objeto');
      // Contato para quem está sendo emprestado
      $table->string('contato')->nullable();
      // Data de devolução combinada
      $table->date('devolucao_combinada')->nullable();
      // Data de devolução
      $table->timestamp('devolvido_em')->nullable();
      // Qual o usuário que emprestou (usuário logado)
      $table->integer('emprestado_de');
      // Se o objeto já foi devolvido
      $table->boolean('devolvido')->default(false);
      // Para qual usuário está sendo emprestado
      $table->string('emprestado_para');
      // created_at e updated_at do laravel
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // Dropa a tabela
    Schema::dropIfExists('emprestimos');
  }
}
