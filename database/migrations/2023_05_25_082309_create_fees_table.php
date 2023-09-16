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
        Schema::create('fees', function (Blueprint $table) {
          $table->bigIncrements('fee_id');
          $table->unsignedBigInteger('academic_id');
          $table->unsignedBigInteger('level_id');
          $table->unsignedBigInteger('fee_type_id');
          $table->string('fee_heading',100)->nullable();
          $table->float('amount',8,2);
          $table->foreign('academic_id', 'academic_id_fk_1000012')->references('academic_id')->on('academics')->onDelete('cascade');
          $table->foreign('level_id', 'level_id_fk_1000013')->references('level_id')->on('levels')->onDelete('cascade');
          $table->foreign('fee_type_id', 'fee_type_id_fk_1000014')->references('fee_type_id')->on('fee_types')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
