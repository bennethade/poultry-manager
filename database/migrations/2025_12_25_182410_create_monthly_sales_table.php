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
        Schema::create('monthly_sales', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->tinyInteger('month'); // 1 - 12
            $table->decimal('total_sales', 20, 2);
            $table->decimal('total_expense', 20, 2);
            $table->decimal('gross_profit', 20, 2);
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['year', 'month']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_sales');
    }
};
