<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->string('request_title')->nullable();
            $table->text('request_description')->nullable();
            $table->text('admin_reply')->nullable();
            $table->text('note')->nullable();
            $table->json('attachments')->nullable();  // Store file paths as JSON
            $table->enum('status', ['pending', 'solved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
