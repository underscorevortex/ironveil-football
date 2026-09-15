<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practice_matches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('coach_id')
                ->constrained('coaches')
                ->cascadeOnDelete();

            $table->foreignId('team_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table->string('opponent');
            $table->date('match_date');
            $table->time('match_time');
            $table->string('venue');

            $table->enum('status', [
                'scheduled',
                'completed',
                'cancelled',
            ])->default('scheduled');

            $table->string('result')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_matches');
    }
};