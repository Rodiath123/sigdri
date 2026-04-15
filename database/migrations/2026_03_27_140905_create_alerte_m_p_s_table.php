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
        Schema::create('alerte_m_p_s', function (Blueprint $table) {
        $table->id();
        $table->foreignId('unite_industrielle_id')->constrained('unite_industrielles')->cascadeOnDelete();
        $table->foreignId('matiere_premiere_id')->constrained('matiere_premieres')->cascadeOnDelete();
        $table->enum('statut', ['disponible', 'tension', 'rupture']);
        $table->text('commentaire')->nullable();
        $table->boolean('est_traitee')->default(false);
        $table->foreignId('traite_par')->nullable()->constrained('users')->nullOnDelete();
        $table->dateTime('date_alerte')->useCurrent();
        $table->dateTime('date_traitement')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerte_m_p_s');
    }
};
