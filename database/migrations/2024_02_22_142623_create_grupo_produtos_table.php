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
    Schema::create('grupo_produto', function (Blueprint $table) {
      $table->id('grupo_produto_id');
      $table->unsignedBigInteger('empresa_id');
      $table->string('grupo_produto_nome', 30);
      $table->string('grupo_produto_tipo', 25);
      $table->timestamps();

      $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('grupo_produto', function (Blueprint $table) {
      $table->dropForeign('grupo_produto_empresa_id_foreign');
    });
    Schema::dropIfExists('grupo_produto');
  }
};
