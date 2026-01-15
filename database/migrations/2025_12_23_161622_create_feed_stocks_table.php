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
        Schema::create('feed_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('received_date');
            $table->string('feed_material')->nullable();
            $table->string('feed_type');
            $table->decimal('quantity_received', 10, 2)->comment('in kg');
            $table->string('supplier');
            $table->decimal('cost', 20, 2);
            $table->decimal('cost_per_kg', 20, 2);
            $table->decimal('remaining_stock',10, 2)->nullable()->comment('in kg');
            $table->string('picture')->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('feed_stocks');
    }
};
