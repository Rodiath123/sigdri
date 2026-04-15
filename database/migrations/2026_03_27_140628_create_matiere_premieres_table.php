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
        Schema::create('matiere_premieres', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 100)->unique();
        $table->enum('origine', ['locale', 'importée']);
        $table->string('filiere', 50);
        $table->boolean('est_actif')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_premieres');
    }
};
