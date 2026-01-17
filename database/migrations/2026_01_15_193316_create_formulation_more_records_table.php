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
        Schema::create('formulation_more_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_formulation_id');
            $table->date('date')->nullable();
            $table->decimal('quantity_used', 10, 2)->comment('in kg')->nullable();
            $table->decimal('quantity_remaining', 10, 2)->comment('in kg')->nullable();
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
        Schema::dropIfExists('formulation_more_records');
    }
};
