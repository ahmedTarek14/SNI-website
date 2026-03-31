<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('why_item_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('why_item_id');
            $table->string('locale')->index();
            $table->text('text');
            $table->unique(['why_item_id', 'locale']);
            $table->foreign('why_item_id')->references('id')->on('why_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_item_translations');
    }
};
