<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dev_featured_project_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dev_featured_project_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->unique(
                ['dev_featured_project_id', 'locale'],
                'dfpt_project_locale_unique'
            );
            $table->foreign('dev_featured_project_id', 'dfpt_project_fk')->references('id')->on('dev_featured_projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dev_featured_project_translations');
    }
};
