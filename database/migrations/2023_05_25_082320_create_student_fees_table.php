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
        Schema::create('student_fees', function (Blueprint $table) {
          $table->bigIncrements('s_fee_id');
          $table->unsignedBigInteger('fee_id');
          $table->unsignedBigInteger('student_id');
          $table->unsignedBigInteger('level_id');
          $table->string('fee_heading',100)->nullable();
          $table->float('amount',8,2);
          $table->foreign('fee_id', 'fee_id_fk_1000015')->references('fee_id')->on('fees')->onDelete('cascade');
          $table->foreign('student_id', 'student_id_fk_1000016')->references('student_id')->on('students')->onDelete('cascade');
          $table->foreign('level_id', 'level_id_fk_1000017')->references('level_id')->on('levels')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
