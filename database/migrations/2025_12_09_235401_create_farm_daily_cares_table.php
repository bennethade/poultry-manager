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
        Schema::create('farm_daily_cares', function (Blueprint $table) {
            $table->id();
            $table->string('care_type');
            $table->string('quantity');
            $table->string('house_or_unit');
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
        Schema::dropIfExists('farm_daily_cares');
    }
};
