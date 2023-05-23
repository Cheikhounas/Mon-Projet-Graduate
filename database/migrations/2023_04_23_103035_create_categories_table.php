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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("titre")->unique();
            $table->bigInteger("nombre_plats")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

/*
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) UNIQUE,
    nombre_plats BIGINT DEFAULT 0
);
et pour annuler la migration :
DROP TABLE IF EXISTS categories;
*/