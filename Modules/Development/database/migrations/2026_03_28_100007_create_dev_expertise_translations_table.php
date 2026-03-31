<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dev_expertise_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dev_expertise_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->text('bullets')->nullable(); // JSON array of bullet strings
            $table->unique(['dev_expertise_id', 'locale']);
            $table->foreign('dev_expertise_id')->references('id')->on('dev_expertise')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dev_expertise_translations');
    }
};
