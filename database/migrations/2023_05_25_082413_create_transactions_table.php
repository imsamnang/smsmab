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
      Schema::create('transactions', function (Blueprint $table) {
        $table->bigIncrements('transaction_id');
        $table->date('transaction_date');
        $table->unsignedBigInteger('fee_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('s_fee_id');
        $table->float('paid',8,2);
        $table->string('remark',50)->nullable();
        $table->string('description',200)->nullable();
        $table->foreign('fee_id', 'fee_id_fk_1000016')->references('fee_id')->on('fees')->onDelete('cascade');
        $table->foreign('user_id', 'user_id_fk_1000017')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('student_id', 'student_id_fk_1000018')->references('student_id')->on('students')->onDelete('cascade');
        $table->foreign('s_fee_id', 's_fee_id_fk_1000019')->references('s_fee_id')->on('student_fees')->onDelete('cascade');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
