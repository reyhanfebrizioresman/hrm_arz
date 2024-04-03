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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('monday')->default(false);
            $table->time('monday_start_time')->nullable();
            $table->time('monday_end_time')->nullable();
            $table->time('monday_break_start')->nullable();
            $table->time('monday_break_end')->nullable();
            $table->integer('monday_late_tolerance')->nullable();
            $table->integer('monday_early_leave_tolerance')->nullable();

            $table->boolean('tuesday')->default(false);
            $table->time('tuesday_start_time')->nullable();
            $table->time('tuesday_end_time')->nullable();
            $table->time('tuesday_break_start')->nullable();
            $table->time('tuesday_break_end')->nullable();
            $table->integer('tuesday_late_tolerance')->nullable();
            $table->integer('tuesday_early_leave_tolerance')->nullable();

            $table->boolean('wednesday')->default(false);
            $table->time('wednesday_start_time')->nullable();
            $table->time('wednesday_end_time')->nullable();
            $table->time('wednesday_break_start')->nullable();
            $table->time('wednesday_break_end')->nullable();
            $table->integer('wednesday_late_tolerance')->nullable();
            $table->integer('wednesday_early_leave_tolerance')->nullable();

            $table->boolean('thursday')->default(false);
            $table->time('thursday_start_time')->nullable();
            $table->time('thursday_end_time')->nullable();
            $table->time('thursday_break_start')->nullable();
            $table->time('thursday_break_end')->nullable();
            $table->integer('thursday_late_tolerance')->nullable();
            $table->integer('thursday_early_leave_tolerance')->nullable();

            $table->boolean('friday')->default(false);
            $table->time('friday_start_time')->nullable();
            $table->time('friday_end_time')->nullable();
            $table->time('friday_break_start')->nullable();
            $table->time('friday_break_end')->nullable();
            $table->integer('friday_late_tolerance')->nullable();
            $table->integer('friday_early_leave_tolerance')->nullable();

            $table->boolean('saturday')->default(false);
            $table->time('saturday_start_time')->nullable();
            $table->time('saturday_end_time')->nullable();
            $table->time('saturday_break_start')->nullable();
            $table->time('saturday_break_end')->nullable();
            $table->integer('saturday_late_tolerance')->nullable();
            $table->integer('saturday_early_leave_tolerance')->nullable();

            $table->boolean('sunday')->default(false);
            $table->time('sunday_start_time')->nullable();
            $table->time('sunday_end_time')->nullable();
            $table->time('sunday_break_start')->nullable();
            $table->time('sunday_break_end')->nullable();
            $table->integer('sunday_late_tolerance')->nullable();
            $table->integer('sunday_early_leave_tolerance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
