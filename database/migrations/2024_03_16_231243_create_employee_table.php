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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone_number', 20);
            $table->string('emergency_number', 20);
            $table->enum('religion', ['islam', 'christianity', 'hinduism', 'buddhism','other']);
            $table->string('identity_no', 20)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('city', 50);
            $table->date('date_of_birth');
            $table->string('place_of_birth', 50);
            $table->text('address');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->enum('employment_status', ['full-time', 'part-time', 'contract']);
            $table->string('picture')->nullable();
            $table->date('joining_date');
            $table->date('exit_date');
            $table->enum('ptkp', ['TK0', 'TK1', 'TK2', 'TK3', 'K0', 'K1', 'K2', 'K3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
