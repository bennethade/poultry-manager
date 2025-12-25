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
        Schema::create('growth_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pig_id');
            $table->foreign('pig_id')->references('id')->on('pigs')->onDelete('cascade');

            $table->date('measurement_date')->nullable();
            $table->integer('age_in_days')->nullable();
            $table->integer('age_in_weeks')->nullable();

            $table->float('weight')->nullable()->comment('Weight in kg');
            $table->string('feed_type')->nullable();
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
        Schema::dropIfExists('growth_records');
    }
};
