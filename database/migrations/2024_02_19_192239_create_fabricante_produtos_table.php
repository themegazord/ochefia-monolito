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
    Schema::create('fabricante_produto', function (Blueprint $table) {
      $table->id('fabricante_produto_id');
      $table->unsignedBigInteger('empresa_id');
      $table->string('fabricante_produto_nome', 90);
      $table->timestamps();

      $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('fabricante_produto', function (Blueprint $table) {
      $table->dropForeign('fabricante_produto_empresa_id_foreign');
    });
    Schema::dropIfExists('fabricante_produtos');
  }
};
