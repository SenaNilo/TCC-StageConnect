<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'conteudos' com as colunas e chave estrangeira especificadas.
     */
    public function up(): void
    {
        Schema::create('conteudos', function (Blueprint $table) {
            // ID da tabela, INT(10) auto_increment not null, chave primária
            $table->increments('id'); // Laravel's equivalent for INT(10) auto_increment PRIMARY KEY

            // ID do autor, INT(5) - pode ser nulo
            // Corrigido para unsignedInteger para compatibilidade com $table->increments('id') de 'usuarios'
            $table->unsignedInteger('autor_id')->nullable();

            // Título do conteúdo, VARCHAR(30)
            $table->string('titulo', 30)->nullable();

            // Descrição do conteúdo, VARCHAR(55)
            $table->string('descricao', 55)->nullable();

            // Data de criação, DATETIME default CURRENT_TIMESTAMP
            $table->timestamp('dt_created')->useCurrent();

            // Data de atualização, DATETIME default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('dt_updated')->useCurrent()->useCurrentOnUpdate();

            // Conteúdo ativo, BOOL DEFAULT TRUE
            $table->boolean('active_content')->default(true);

            // Chave estrangeira para 'usuarios'
            // Garante que 'usuarios' já exista antes desta migração ser executada.
            $table->foreign('autor_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('set null')->nullable(); // Ou 'cascade', 'restrict', 'no action'
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'conteudos' se a migração for revertida.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteudos');
    }
};
