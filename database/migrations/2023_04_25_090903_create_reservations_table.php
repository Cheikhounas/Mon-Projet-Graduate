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
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('convives');
            $table->string('date');
            $table->string('allergies')->nullable();
            $table->enum('statut', ['avenir', 'encours','terminer']);
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
/*
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT DEFAULT 0,
    convives BIGINT,
    date VARCHAR(255),
    allergies VARCHAR(255) NULL,
    statut ENUM('avenir', 'encours', 'terminer'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
pour annuler la migrations
DROP TABLE IF EXISTS reservations;

*/