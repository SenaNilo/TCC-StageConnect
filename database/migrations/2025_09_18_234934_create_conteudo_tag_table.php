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
        Schema::create('conteudo_tag', function (Blueprint $table) {
            $table->unsignedInteger('id_conteudo');
            $table->unsignedInteger('id_tag');

            $table->foreign('id_conteudo')->references('id')->on('conteudos')->onDelete('cascade');
            $table->foreign('id_tag')->references('id')->on('tags')->onDelete('cascade');

            $table->primary(['id_conteudo', 'id_tag']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteudo_tag');
    }
};
