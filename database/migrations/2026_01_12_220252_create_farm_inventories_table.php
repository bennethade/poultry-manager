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
        Schema::create('farm_inventories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('cost', 20,2)->nullable();
            $table->string('picture')->nullable();
            $table->text('remarks')->nullable();
            $table->string('source')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('farm_inventories');
    }
};
