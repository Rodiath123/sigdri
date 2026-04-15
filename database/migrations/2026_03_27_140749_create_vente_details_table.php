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
        Schema::create('vente_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('declaration_id')->constrained('declarations')->cascadeOnDelete();
        $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
        $table->decimal('quantite_vendue', 15, 2);
        $table->enum('marche', ['local', 'export']);
        $table->decimal('chiffre_affaires', 15, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vente_details');
    }
};
