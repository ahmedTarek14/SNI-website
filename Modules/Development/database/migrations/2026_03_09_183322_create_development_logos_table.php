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
        Schema::create('development_logos', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->unsignedBigInteger('development_id')->nullable();
            $table->foreign('development_id')->references('id')->on('developments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_logos');
    }
};
