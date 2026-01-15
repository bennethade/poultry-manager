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
        Schema::create('farm_inventory_more_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_inventory_id');
            $table->date('date');
            $table->string('quantity_used')->nullable();
            $table->string('quantity_remaining')->nullable();
            $table->string('current_state')->nullable();
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
        Schema::dropIfExists('farm_inventory_more_records');
    }
};
