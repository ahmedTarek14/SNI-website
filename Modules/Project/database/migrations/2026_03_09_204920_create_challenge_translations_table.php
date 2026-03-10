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
        Schema::create('challenge_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('challenge')->nullable();
            $table->string('solution')->nullable();
            $table->string('result')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('challenge_id');
            $table->string('locale')->index();
            $table->unique(['challenge_id', 'locale']);
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_translations');
    }
};
