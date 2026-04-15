<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alerte_m_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unite_industrielle_id')->constrained()->onDelete('cascade');
            $table->foreignId('matiere_premiere_id')->constrained()->onDelete('cascade');
            $table->enum('statut', ['disponible', 'tension', 'rupture'])->default('disponible');
            $table->text('commentaire')->nullable();
            $table->boolean('est_traitee')->default(false);
            $table->foreignId('traite_par')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('date_alerte')->useCurrent();
            $table->timestamp('date_traitement')->nullable();
            $table->timestamps();

            // Unicité : une seule alerte active par couple (unité, MP)
            $table->unique(['unite_industrielle_id', 'matiere_premiere_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alerte_m_p_s');
    }
};