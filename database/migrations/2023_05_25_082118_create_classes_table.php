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
        Schema::create('classes', function (Blueprint $table) {
          $table->bigIncrements('class_id');
          $table->unsignedBigInteger('academic_id');
          $table->foreign('academic_id', 'academic_id_fk_100005')->references('academic_id')->on('academics')->onDelete('cascade');
          $table->unsignedBigInteger('program_id');
          $table->foreign('program_id', 'program_id_fk_1000011')->references('program_id')->on('programs')->onDelete('cascade');
          $table->unsignedBigInteger('level_id');
          $table->foreign('level_id', 'level_id_fk_100006')->references('level_id')->on('levels')->onDelete('cascade');
          $table->unsignedBigInteger('shift_id');
          $table->foreign('shift_id', 'shift_id_fk_100007')->references('shift_id')->on('shifts')->onDelete('cascade');
          $table->unsignedBigInteger('time_id');
          $table->foreign('time_id', 'time_id_fk_100008')->references('time_id')->on('times')->onDelete('cascade');
          $table->unsignedBigInteger('group_id');
          $table->foreign('group_id', 'group_id_fk_100009')->references('group_id')->on('groups')->onDelete('cascade');
          $table->unsignedBigInteger('batch_id');
          $table->foreign('batch_id', 'batch_id_fk_1000010')->references('batch_id')->on('batches')->onDelete('cascade');
          $table->date('start_date');
          $table->date('end_date');
          $table->boolean('status')->default(true);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
