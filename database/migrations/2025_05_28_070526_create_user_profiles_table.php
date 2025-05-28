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
        Schema::create('user_profiles', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('user_id');
            $table->json('technical_skills')->nullable();
            $table->json('soft_skills')->nullable();
            $table->string('skill_level')->nullable();
            $table->json('profession')->nullable();
            $table->json('interests')->nullable();
            $table->string('availability')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
                
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
