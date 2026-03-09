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
        Schema::create('smart_benefit_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->unsignedBigInteger('smart_benefit_id');
            $table->string('locale')->index();
            $table->unique(['smart_benefit_id', 'locale']);
            $table->foreign('smart_benefit_id')->references('id')->on('smart_benefits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_benefit_transltaions');
    }
};
