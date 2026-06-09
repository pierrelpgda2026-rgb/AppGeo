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
        Schema::create('lieux', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->decimal('latitude', 10, 6);
    $table->decimal('longitude', 10, 6);
    $table->string('image')->nullable();
    $table->foreignId('type_id')->constrained('types')->onDelete('cascade'); // ← clé étrangère
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lieux');
    }
};
