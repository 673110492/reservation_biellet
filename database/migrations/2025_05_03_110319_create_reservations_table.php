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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->nullable();
            $table->string('telephone');
            $table->string('adresse')->nullable();
            $table->enum('genre', ['Homme', 'Femme', 'Autre'])->nullable();
            $table->date('date_reservation');
            $table->enum('statut', ['en_attente', 'confirmee', 'annulee'])->default('en_attente');

            // Nouvelles colonnes
            $table->unsignedBigInteger('vehicule_id');
            $table->unsignedBigInteger('agence_id');
            $table->unsignedBigInteger('trajet_id');
            $table->integer(column: 'nombre_places')->default(1);
            $table->decimal('prix_total', 10, 2)->nullable();

            // Clés étrangères
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
            $table->foreign('agence_id')->references('id')->on('agences')->onDelete('cascade');
            $table->foreign('trajet_id')->references('id')->on('trajets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
