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
    Schema::create('produtos', function (Blueprint $table) {
      $table->id('produto_id');
      $table->unsignedBigInteger('empresa_id');
      $table->unsignedBigInteger('grupo_produto_id');
      $table->unsignedBigInteger('subgrupo_produto_id');
      $table->unsignedBigInteger('fabricante_produto_id');
      $table->unsignedBigInteger('classe_produto_id');
      $table->unsignedBigInteger('unidade_produto_id');
      $table->string('produto_nome', 155);
      $table->decimal('produto_estoque', 15, 2)->default(0);
      $table->decimal('produto_preco', 15, 2)->default(0);
      $table->timestamps();
    });

    Schema::table('produtos', function (Blueprint $table) {
      $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
      $table->foreign('grupo_produto_id')->references('grupo_produto_id')->on('grupo_produto');
      $table->foreign('subgrupo_produto_id')->references('subgrupo_produto_id')->on('subgrupo_produto');
      $table->foreign('fabricante_produto_id')->references('fabricante_produto_id')->on('fabricante_produto');
      $table->foreign('classe_produto_id')->references('classe_produto_id')->on('classe_produto');
      $table->foreign('unidade_produto_id')->references('unidade_produto_id')->on('unidade_produto');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('produtos', function (Blueprint $table) {
      $table->dropForeign('produtos_empresa_id_foreign');
      $table->dropForeign('produtos_grupo_produto_id_foreign');
      $table->dropForeign('produtos_subgrupo_produto_id_foreign');
      $table->dropForeign('produtos_fabricante_produto_id_foreign');
      $table->dropForeign('produtos_classe_produto_id_foreign');
      $table->dropForeign('produtos_unidade_produto_id_foreign');
    });
    Schema::dropIfExists('produtos');
  }
};
