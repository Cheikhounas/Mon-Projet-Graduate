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
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jour_id')->unsigned()->index();
            $table->string('ouverture_midi');
            $table->string('fermeture_midi');
            $table->string('ouverture_soir');
            $table->string('fermeture_soir');

            $table->foreign('jour_id')->references('id')->on('jours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaires');
    }
};
/*
CREATE TABLE horaires (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    jour_id BIGINT UNSIGNED,
    ouverture_midi VARCHAR(255),
    fermeture_midi VARCHAR(255),
    ouverture_soir VARCHAR(255),
    fermeture_soir VARCHAR(255),
    FOREIGN KEY (jour_id) REFERENCES jours(id) ON DELETE CASCADE
);
et pour annuler la migration de la table `horaires`
DROP TABLE IF EXISTS horaires;

*/