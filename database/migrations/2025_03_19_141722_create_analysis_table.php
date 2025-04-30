<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->string('column'); // Example column for storing data
            $table->string('image'); // Stores the uploaded file path
            $table->text('description'); // Description of the file or analysis
            $table->text('log')->nullable(); // Stores any logs related to the analysis
            $table->timestamps(); // Adds 'created_at' and 'updated_at'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analysis');
    }
};