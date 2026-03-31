<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dev_why_item_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dev_why_item_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['dev_why_item_id', 'locale']);
            $table->foreign('dev_why_item_id')->references('id')->on('dev_why_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dev_why_item_translations');
    }
};
