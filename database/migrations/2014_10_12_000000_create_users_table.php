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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('email')->unique();


            $table->string('user_type')->comment('1:Admin, 2:Staff');
            $table->tinyInteger('status')->nullable()->comment('0:active, 1:inactive');
            $table->string('keep_track');

           
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('admission_date')->nullable();
            
           
            $table->string('address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('qualification')->nullable();
            $table->string('work_experience')->nullable();
            $table->text('note')->nullable();

            $table->integer('is_delete')->default(0)->comment('0: not deleted, 1: deleted');



            
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
