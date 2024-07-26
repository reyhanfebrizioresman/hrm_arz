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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('position')->nullable();
            $table->date('period')->nullable();
            $table->integer('basic_salary')->nullable();
            $table->integer('overtime_pay')->nullable();
            $table->integer('late_pay')->nullable();
            $table->integer('total_pay')->nullable();
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
