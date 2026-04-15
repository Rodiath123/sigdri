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
        Schema::create('declarations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('unite_industrielle_id')->constrained('unite_industrielles')->cascadeOnDelete();
        $table->integer('annee');
        $table->enum('trimestre', ['1', '2', '3', '4']);
        $table->enum('statut', ['brouillon', 'en_attente', 'validee', 'rejetee'])->default('en_attente');
        $table->text('commentaire_rejet')->nullable();
        $table->foreignId('valide_par')->nullable()->constrained('users')->nullOnDelete();
        $table->dateTime('date_soumission')->useCurrent();
        $table->dateTime('date_validation')->nullable();
        $table->timestamps();

        // Une seule déclaration par unité/trimestre/année
        $table->unique(['unite_industrielle_id', 'annee', 'trimestre']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarations');
    }
};
