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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string("titre")->unique();
            $table->bigInteger("nombre_formules")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

/*
CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) UNIQUE,
    nombre_formules BIGINT DEFAULT 0
);
et pour l'annulation de menu
DROP TABLE IF EXISTS menus;

*/