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
        Schema::create('breeding_records', function (Blueprint $table) {
            $table->id();
            // CREATE COLUMNS FIRST
            $table->unsignedBigInteger('sow_id');
            $table->unsignedBigInteger('boar_id');

            $table->foreign('sow_id')->references('id')->on('pigs')->onDelete('cascade');
            $table->foreign('boar_id')->references('id')->on('pigs')->onDelete('cascade');
            
            $table->string('type')->nullable()->comment('Natural or Artificial Insemination');
            $table->date('expected_farrow_date')->nullable();
            $table->date('actual_farrow_date')->nullable();
            $table->integer('number_of_born_alive')->nullable();
            $table->integer('number_of_stillborn')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeding_records');
    }
};
