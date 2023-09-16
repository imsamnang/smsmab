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
        Schema::create('students', function (Blueprint $table) {
          $table->bigIncrements('student_id');
          $table->string('first_name',20)->nullable();
          $table->string('last_name)',20)->nullable();
          $table->boolean('sex')->nullable();
          $table->date('dob')->nullable();
          $table->string('100')->nullable();
          $table->string('status')->nullable();
          $table->string('nationality',50)->nullable();
          $table->string('national_card',50)->nullable();
          $table->string('passport',50)->nullable();
          $table->string('phone',50)->nullable();
          $table->string('village',50)->nullable();
          $table->string('commune',50)->nullable();
          $table->string('district',50)->nullable();
          $table->string('province',50)->nullable();
          $table->string('current_address',100)->nullable();
          $table->date('dateregistered',50)->nullable();
          $table->string('photo',200)->nullable();
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id', 'user_id_fk_100004')->references('id')->on('users')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
