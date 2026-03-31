<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('core_value_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('core_value_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['core_value_id', 'locale']);
            $table->foreign('core_value_id')->references('id')->on('core_values')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_value_translations');
    }
};
