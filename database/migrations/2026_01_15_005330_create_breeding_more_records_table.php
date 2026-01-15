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
        Schema::create('breeding_more_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('breed_id');
            $table->date('date');
            $table->string('number_alive')->nullable();
            $table->string('still_birth')->nullable();
            $table->string('more_detail')->nullable();
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeding_more_records');
    }
};
