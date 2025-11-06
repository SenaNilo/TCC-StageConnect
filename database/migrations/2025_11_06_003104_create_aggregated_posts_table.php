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
       Schema::create('aggregated_posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('source_name');
        $table->string('category')->nullable(); // <-- COLUNA NOVA AQUI
        $table->text('source_url');
        $table->text('snippet')->nullable();
        $table->text('thumbnail_url')->nullable(); // <-- COLUNA NOVA AQUI
        $table->timestamp('published_at')->nullable();
        $table->string('guid')->unique(); // Coloquei depois
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aggregated_posts');
    }
};
