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
        Schema::create('feed_formulations', function (Blueprint $table) {
            $table->id();
            $table->date('formulation_date');
            $table->string('feed_stage')->nullable();
            $table->string('ingredients_used')->nullable();
            $table->decimal('quantity')->nullable();
            $table->decimal('cost')->nullable();
            $table->decimal('total_output')->nullable();
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('staff_id');
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
        Schema::dropIfExists('feed_formulations');
    }
};
