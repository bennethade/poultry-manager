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
        Schema::create('pigs', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id')->unique();
            $table->string('source')->nullable();
            $table->date('dob')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('stage')->nullable();
            $table->date('date_entry')->nullable();
            $table->string('breed')->nullable();
            $table->decimal('initial_weight', 8, 2)->nullable();
            $table->decimal('current_weight', 8, 2)->nullable();
            $table->string('production_stage')->nullable();
            $table->boolean('status')->default(true);
            $table->string('inactive_reason')->nullable();
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pigs');
    }
};
