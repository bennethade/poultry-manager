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
        Schema::create('heating_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pig_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->text('measurement_detail')->nullable();
            $table->text('observation')->nullable();
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('staff_id')->comment('created by');
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
        Schema::dropIfExists('heating_records');
    }
};
