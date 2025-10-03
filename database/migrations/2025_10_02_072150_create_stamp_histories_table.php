<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStampHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('stamp_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('protected_area_id');
            $table->unsignedBigInteger('stamp_id');
            $table->date('assigned_date')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('protected_area_id')->references('id')->on('protected_areas')->onDelete('cascade');
            $table->foreign('stamp_id')->references('id')->on('stamps')->onDelete('cascade');

            // Unique constraint
            $table->unique(['protected_area_id', 'stamp_id'], 'unique_area_stamp');

            // Indexes
            $table->index('assigned_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stamp_histories');
    }
}
