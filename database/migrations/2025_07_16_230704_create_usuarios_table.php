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
        Schema::create('usuarios', function (Blueprint $table) {
            // ID da tabela, INT(10) auto_increment not null, chave primária
            $table->increments('id'); // Laravel's equivalent for INT(10) auto_increment PRIMARY KEY

            // Nome do usuário, VARCHAR(25) not null
            $table->string('name_user', 65)->nullable(false);

            // Email do usuário, VARCHAR(20) not null unique
            // ATENÇÃO: VARCHAR(20) para email é muito curto. Considere aumentar para 255.
            $table->string('email', 50)->unique()->nullable(false);

            // Senha do usuário, VARCHAR(100) not null
            $table->string('password_user', 100)->nullable(false);

            // Tipo de usuário, ENUM('ADM', 'ALU') not null
            $table->enum('type_user', ['ADM', 'ALU'])->nullable(false);

            // Data de criação, DATETIME default CURRENT_TIMESTAMP
            $table->timestamp('dt_created')->useCurrent();

            // Usuário ativo, BOOL DEFAULT TRUE
            $table->boolean('active_user')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
