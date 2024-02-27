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
    Schema::create('subgrupo_produto', function (Blueprint $table) {
      $table->id('subgrupo_produto_id');
      $table->unsignedBigInteger('empresa_id');
      $table->string('subgrupo_produto_nome', 30);
      $table->timestamps();

      $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('subgrupo_produto', function (Blueprint $table) {
      $table->dropForeign('subgrupo_produto_empresa_id_foreign');
    });
    Schema::dropIfExists('subgrupo_produto');
  }
};
