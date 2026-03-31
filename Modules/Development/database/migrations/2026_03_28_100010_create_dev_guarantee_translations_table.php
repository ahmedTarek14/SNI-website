<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dev_guarantee_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dev_guarantee_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['dev_guarantee_id', 'locale']);
            $table->foreign('dev_guarantee_id')->references('id')->on('dev_guarantees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dev_guarantee_translations');
    }
};
