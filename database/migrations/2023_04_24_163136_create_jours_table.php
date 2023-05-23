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
        Schema::create('jours', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jours');
    }
};
/*
CREATE TABLE jours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) UNIQUE
);
et pour annuler la table
DROP TABLE IF EXISTS jours;

*/
