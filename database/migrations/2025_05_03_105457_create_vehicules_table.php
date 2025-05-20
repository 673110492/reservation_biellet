<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_id')->constrained('agences');
            $table->string('numero_immatriculation')->unique();
            $table->string('type'); // ex: bus
            $table->integer('nombre_places');
            $table->string('image')->nullable(); // chemin vers l'image du véhicule
            $table->enum('status', ['plein', 'vide'])->default('vide'); // statut du véhicule
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
