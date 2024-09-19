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
        Schema::create('candidates', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();         // Add slug column and make it unique
                $table->string('photo')->nullable();   // Path for candidate's photo
                $table->text('cv');                    // Candidate's CV as text
                $table->integer('votes')->default(0);  // Total votes
                $table->integer('likes')->default(0);  // Like count
                $table->integer('dislikes')->default(0); // Dislike count
                $table->boolean('active')->default(true); // Add active column, default true
                $table->foreignId('governorate_id')->nullable()->constrained()->onDelete('set null');
                $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
