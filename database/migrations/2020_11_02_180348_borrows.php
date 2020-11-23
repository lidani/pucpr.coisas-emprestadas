<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Borrows extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('borrows', function (Blueprint $table) {
      $table->id();
      $table->string('description');
      $table->timestamps();
      $table->integer('user_id');

      $table->integer('from_id')
      ->unsigned()
      ->nullable()
      ->foreign('from_id')
      ->references('id')
      ->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('borrows');
  }
}
