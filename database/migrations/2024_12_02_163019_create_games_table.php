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
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('photo_path')->nullable();
            $table->string('game_id')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('reward', 10, 2);
            $table->date('start_date');
            $table->time('start_time')->default('00:00:00');
            $table->integer('current_round')->default(1);
            $table->time('last_processed_time')->default('00:00:00');
            $table->json('winning_numbers');
            $table->date('end_date')->nullable();
            $table->enum('recurrence', [
                'hourly',
                'every_2_hours',
                'every_4_hours',
                'every_8_hours',
                'every_12_hours',
                'daily',
                'twice_a_week',
                'weekly',
                'bi_weekly',
                'monthly',
                'every_2_months',
                'every_3_months',
                'every_6_months',
                'yearly'
            ])->default('daily');
            $table->time('draw_time')->default('12:00:00');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
