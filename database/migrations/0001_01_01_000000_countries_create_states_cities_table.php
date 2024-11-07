<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 5);
            $table->string('phone_code', 5);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 255);
            $table->string('code', 5);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 255);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
};
