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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('empresa_id');
            $table->string('empresa_nome', 255);
            $table->string('empresa_cnpj', 14)->unique();
            $table->string('empresa_descricao', 30);
            $table->string('empresa_logo')->nullable();
            $table->integer('quantidade_donos')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            Schema::dropIfExists('empresas');
        });
    }
};
