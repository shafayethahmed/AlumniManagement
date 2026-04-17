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
        Schema::create('pendingmember', function (Blueprint $table) {
            $table->id();
            $table->string('academic_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->integer('admission_year');
            $table->integer('graduation_year');
            $table->string('department');
            $table->decimal('final_result', 4, 2)->nullable();
            $table->string('status'); // e.g., Active, Inactive, etc.
            $table->string('company')->nullable();
            $table->string('job')->nullable();
            $table->string('password');
            $table->enum('member_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendingmember');
    }
};
