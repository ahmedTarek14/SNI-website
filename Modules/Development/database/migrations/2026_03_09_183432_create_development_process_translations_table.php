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
        Schema::create('development_process_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->unsignedBigInteger('development_process_id');
            $table->string('locale')->index();
            $table->unique(['development_process_id', 'locale'], 'dev_process_trans_unique');
            $table->foreign('development_process_id')->references('id')->on('development_processes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_process_translations');
    }
};
