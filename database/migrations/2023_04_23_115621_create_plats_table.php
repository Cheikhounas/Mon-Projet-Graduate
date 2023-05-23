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
        Schema::create('plats', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->bigInteger('categorie_id')->unsigned()->index();
            $table->longText('description');
            $table->bigInteger('prix');
            
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('titre')->references('titre')->on('galerie')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plats');
    }
};

/*
CREATE TABLE plats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    categorie_id BIGINT UNSIGNED,
    description LONGTEXT,
    prix BIGINT,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (titre) REFERENCES galerie(titre) ON DELETE CASCADE
);

CREATE INDEX index_plats_categorie_id ON plats (categorie_id);

et pour annuler les migrations
DROP TABLE IF EXISTS plats;

*/