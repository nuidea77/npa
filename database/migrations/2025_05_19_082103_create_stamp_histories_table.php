<?php
// database/migrations/XXXX_XX_XX_XXXXXX_create_stamp_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
    if (!Schema::hasTable('stamp_histories')) {
        Schema::create('stamp_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('stamp_id');
            $table->timestamps( 'created_at', 'updated_at');

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('stamp_id')->references('id')->on('stamps')->onDelete('cascade');
        });
    }


    }

    public function down(): void
    {
        Schema::dropIfExists('stamp_histories');
    }
};
