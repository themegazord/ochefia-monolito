<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classe_produto', function (Blueprint $table) {
          $table->id('classe_produto_id');
          $table->unsignedBigInteger('empresa_id');
          $table->string('classe_produto_nome', 100);
          $table->timestamps();

          $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('classe_produto', function (Blueprint $table) {
        $table->dropForeign('classe_produto_empresa_id_foreign');
      });
      Schema::dropIfExists('classe_produto');
    }
};
