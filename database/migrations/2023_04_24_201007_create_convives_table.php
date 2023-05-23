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
        Schema::create('convives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nombre_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convives');
    }
};

/*
CREATE TABLE convives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_max BIGINT
);
et pour annuler la migration :
DROP TABLE IF EXISTS convives;

*/