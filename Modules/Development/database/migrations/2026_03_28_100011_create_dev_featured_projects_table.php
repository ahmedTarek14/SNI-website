<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dev_featured_projects', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('tech')->nullable(); // tech stack label
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dev_featured_projects');
    }
};
