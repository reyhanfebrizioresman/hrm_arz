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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', ['izin', 'cuti', 'sakit'])->nullable();
            $table->decimal('overtime', 8, 2)->nullable(); // Format untuk waktu lembur dalam jam
            $table->dateTime('clock_in');
            $table->dateTime('clock_out');
            $table->date('date');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
