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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Reference to the candidate
            $table->string('session_id')->nullable();   // Session ID for non-authenticated users
            $table->unsignedBigInteger('user_id')->nullable(); // User ID for authenticated users
            $table->timestamps();

            // Add foreign key constraint if using a candidates table
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');

            // Ensure unique vote per user or session for each candidate
            $table->unique(['candidate_id', 'session_id']);
            $table->unique(['candidate_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
