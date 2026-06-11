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
        Schema::create('goals', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->string('title');

            $table->text('description')->nullable();

            $table->integer('target_value')->default(1);

            $table->integer('current_value')->default(0);

            $table->date('target_date')->nullable();

            $table->enum('status', [
                'not_started',
                'in_progress',
                'completed'
            ])->default('not_started');

            $table->string('goal_type')->default('course');

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
