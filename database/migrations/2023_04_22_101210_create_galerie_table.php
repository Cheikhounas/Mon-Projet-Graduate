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
        Schema::create('galerie', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('image');

            
            $table->index(['titre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galerie');
    }
};

/*
 CREATE TABLE galerie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    image VARCHAR(255)
);
CREATE INDEX index_galerie_titre ON galerie (titre);
 et pour supprimer
DROP TABLE IF EXISTS galerie;
 */