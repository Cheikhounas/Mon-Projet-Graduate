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
        Schema::create('formules', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('plats');
            $table->bigInteger('menu_id')->unsigned()->index();
            $table->longText('description');
            $table->bigInteger('prix');
            
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formules');
    }
};
/*
CREATE TABLE formules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    plats VARCHAR(255),
    menu_id BIGINT UNSIGNED,
    description LONGTEXT,
    prix BIGINT,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE
);
et pour annuler la table
DROP TABLE IF EXISTS formules;

*/
