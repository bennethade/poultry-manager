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
        Schema::create('disease_incidences', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('pig_id');
            $table->text('symptoms_observed');
            $table->string('suspected_disease');
            $table->string('action_taken');
            $table->string('vet_name')->nullable();
            $table->string('outcome')->nullable();

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
        Schema::dropIfExists('disease_incidences');
    }
};
