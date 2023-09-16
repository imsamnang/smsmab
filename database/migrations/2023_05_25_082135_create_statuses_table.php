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
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('status_id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_1000011')->references('student_id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id', 'class_id_fk_1000012')->references('class_id')->on('classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
