<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('protected_areas', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable(); // Translatable талбар
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('protected_areas');
    }
};

