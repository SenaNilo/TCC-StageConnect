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
        Schema::table('conteudos', function (Blueprint $table) {
            // o after é dps da coluna descricao
            $table->string('img', 400)->nullable()->after('descricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('conteudos', function (Blueprint $table) {
            // Remove a coluna 'img' se a migração for revertida
            $table->dropColumn('img');
        });
    }
};
