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
        Schema::table('sick_leaves', function (Blueprint $table) {
            $table->enum('status', ['approve','pending'])->nullable()->after('employee_id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sick_leaves', function (Blueprint $table) {
            //
        });
    }
};
