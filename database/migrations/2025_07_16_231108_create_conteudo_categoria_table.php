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
        Schema::create('conteudo_categoria', function (Blueprint $table) {
            // ID do conteúdo, INT(10) not null
            // CORRIGIDO: Deve ser unsignedInteger para compatibilidade com 'increments()'
            $table->unsignedInteger('id_conteudo')->nullable(false);

            // ID da categoria, INT(10) not null
            // CORRIGIDO: Deve ser unsignedInteger para compatibilidade com 'increments()'
            $table->unsignedInteger('id_categoria')->nullable(false);

            // Chave primária composta
            $table->primary(['id_conteudo', 'id_categoria']);

            // Chave estrangeira para 'conteudos'
            // Garante que 'conteudos' já exista antes desta migração ser executada.
            // REMOVIDO: ->nullable() aqui, pois não se aplica à restrição de chave estrangeira
            $table->foreign('id_conteudo')
                  ->references('id')
                  ->on('conteudos')
                  ->onDelete('cascade');

            // Chave estrangeira para 'categorias'
            // Garante que 'categorias' já exista antes desta migração ser executada.
            // REMOVIDO: ->nullable() aqui, pois não se aplica à restrição de chave estrangeira
            $table->foreign('id_categoria')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteudo_categoria');
    }
};
