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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nim');
            $table->enum('position', ['komisaris', 'bendahara', 'sekretaris', 'anggota']);
            $table->string('profile_image')->nullable();
            $table->string('study_program');
            $table->text('hobbies')->nullable();
            $table->string('status')->nullable();
            $table->json('social_media_links')->nullable();
            $table->text('favorite_quote')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
