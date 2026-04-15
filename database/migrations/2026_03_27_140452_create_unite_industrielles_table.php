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
        Schema::create('unite_industrielles', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 150);
        $table->string('localisation', 255);
        $table->string('departement', 50);
        $table->string('filiere', 50);
        $table->decimal('capacite_installee', 10, 2);
        $table->enum('regime', ['Privé', 'Public', 'Mixte']);
        $table->string('contact_nom', 100);
        $table->string('contact_telephone', 20);
        $table->string('contact_email', 100);
        $table->boolean('est_actif')->default(true);
        $table->timestamps();
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unite_industrielles');
    }
};
