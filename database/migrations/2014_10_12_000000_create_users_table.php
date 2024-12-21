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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_name')->nullable();
            $table->string('uid', 6)->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('lgas_id')->index()->nullable()->constrained('lgas')->cascadeOnDelete();
            $table->foreignId('states_id')->index()->nullable()->constrained('states')->cascadeOnDelete();
            $table->foreignId('nationalities_id')->index()->nullable()->constrained('nationalities')->cascadeOnDelete();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->enum('role', ['ADMIN', 'USER'])->default('USER');
            $table->boolean('is_active')->default(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('profile_updated_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('virtual_account_number')->nullable()->unique();
            $table->string('bank_name')->nullable();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
