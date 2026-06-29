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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('slug')->unique();
            $table->integer('prix');
            $table->string('matiere')->nullable();
            $table->text('description')->nullable();
            $table->text('description_courte')->nullable();
            $table->string('image')->nullable();
            $table->boolean('edition_limitee')->default(false);
            $table->boolean('nouveau')->default(false);
            $table->integer('stock')->default(0);
            $table->string('dimensions')->nullable();
            $table->text('caracteristiques')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
