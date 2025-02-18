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
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('title')->unique();
            $table->string('image_url');
            $table->text('description');
            $table->unsignedInteger('views')->default(0);
            $table->boolean('published')->default(false);
            $table->timestamps();
            
            $table->foreign('type_id')->references('id')->on('m_program_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
