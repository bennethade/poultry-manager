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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id');
            $table->string('item_type')->nullable();
            $table->string('reason');
            $table->string('quantity')->nullable();
            $table->float('price');
            $table->boolean('sold_on_discount')->default(false);
            $table->float('discounted_price')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->date('date');
            $table->longText('notes')->nullable();
            $table->string('picture')->nullable();
            $table->smallInteger('staff_id');
            $table->smallInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
