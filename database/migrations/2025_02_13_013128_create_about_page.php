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
        Schema::create('about_page', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_1_url');
            $table->string('image_2_url');
            $table->text('vision');
            $table->text('mision');
            $table->string('bg_color');
            $table->string('partners_title');
            $table->text('partners_description');
            $table->boolean('is_hero_visible')->default(true);
            $table->boolean('is_vision_visible')->default(true);
            $table->boolean('is_members_visible')->default(true);
            $table->boolean('is_programs_visible')->default(true);
            $table->boolean('is_partners_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page');
    }
};
