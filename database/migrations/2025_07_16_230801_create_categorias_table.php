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
        Schema::create('categorias', function (Blueprint $table) {
            // ID da tabela, INT(10) auto_increment not null, chave primária
            $table->increments('id'); // Laravel's equivalent for INT(10) auto_increment PRIMARY KEY

            // Nome da categoria, VARCHAR(25)
            $table->string('name_category', 25)->nullable(); // VARCHAR(25)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
