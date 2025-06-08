<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
{
    Schema::create('program_registrations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
        $table->foreignId('customer_id')->nullable();
        $table->string('firstname');
        $table->string('lastname');
        $table->string('hz')->nullable();
        $table->string('position')->nullable();
        $table->string('sex')->nullable();
        $table->string('email');
        $table->string('phone');
        $table->text('answer')->nullable();
        $table->timestamp('registered_at')->useCurrent();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_registrations');
    }
};
