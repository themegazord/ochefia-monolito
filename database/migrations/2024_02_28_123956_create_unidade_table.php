<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('unidade_produto', function (Blueprint $table) {
      $table->id('unidade_produto_id');
      $table->unsignedBigInteger('empresa_id');
      $table->string('unidade_produto_nome', 50);
      $table->timestamps();

      $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('unidade_produto', function (Blueprint $table) {
      $table->dropForeign('unidade_produto_empresa_id_foreign');
    });
    Schema::dropIfExists('unidade_produto');
  }
};
