<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('militants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique(); // Généré auto, irréversible
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->string('localite')->nullable();
            $table->string('etablissement')->nullable();
            $table->string('section')->nullable(); // Ex: Danané, Yamoussoukro...
            $table->string('sexe')->default('Homme'); // Homme / Femme
            $table->string('niveau_etude')->default('secondaire'); // primaire / secondaire / supérieur
            $table->string('statut')->default('actif'); // actif / inactif / radié
            $table->integer('annee_adhesion')->default(2026);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('militants');
    }
};
