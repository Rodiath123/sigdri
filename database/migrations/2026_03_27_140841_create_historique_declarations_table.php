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
       Schema::create('historique_declarations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('declaration_id')->constrained('declarations')->cascadeOnDelete();
        $table->foreignId('utilisateur_id')->constrained('users')->cascadeOnDelete();
        $table->string('action', 20); // creation, modification, validation, rejet
        $table->json('ancienne_valeur')->nullable();
        $table->json('nouvelle_valeur')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_declarations');
    }
};
