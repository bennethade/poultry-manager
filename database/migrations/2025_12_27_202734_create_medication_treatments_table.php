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
        Schema::create('medication_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pig_id');
            $table->date('date');
            $table->text('drug_name');
            $table->string('dosage');
            $table->string('duration');
            $table->string('administered_by')->nullable();
            $table->string('remarks')->nullable();

            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pig_id')->references('id')->on('pigs')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_treatments');
    }
};
