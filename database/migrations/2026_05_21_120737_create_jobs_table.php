<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employer_profile_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('title');
            $table->text('description');

            $table->decimal('salary', 12, 2)->nullable();

            $table->string('location')->nullable();

            $table->enum('job_type', [
                'full-time',
                'part-time',
                'remote',
                'contract'
            ]);

            $table->date('deadline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
