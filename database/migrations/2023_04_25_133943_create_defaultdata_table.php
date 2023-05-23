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
        Schema::create('defaultdata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string("convives");
            $table->string("allergies")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defaultdata');
    }
};

/*
CREATE TABLE defaultdata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    convives VARCHAR(255),
    allergies VARCHAR(255) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
et pour annuler la migration
DROP TABLE IF EXISTS defaultdata;

*/