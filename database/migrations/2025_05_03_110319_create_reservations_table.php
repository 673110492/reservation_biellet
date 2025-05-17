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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->nullable();
            $table->string('telephone');
            $table->string('adresse')->nullable();
            $table->enum('genre', ['Homme', 'Femme', 'Autre'])->nullable();
            $table->date('date_reservation');

            $table->enum('ville_depart', [
                'Douala', 'Yaoundé', 'Bafoussam', 'Garoua', 'Maroua',
                'Bamenda', 'Bertoua', 'Ngaoundéré', 'Ebolowa', 'Limbe'
            ]);

            $table->enum('ville_arrivee', [
                'Douala', 'Yaoundé', 'Bafoussam', 'Garoua', 'Maroua',
                'Bamenda', 'Bertoua', 'Ngaoundéré', 'Ebolowa', 'Limbe'
            ]);

            $table->foreignId('horaire_id')->constrained('horaires')->onDelete('cascade');
            $table->enum('statut', ['en_attente', 'confirmee', 'annulee'])->default('en_attente');
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
