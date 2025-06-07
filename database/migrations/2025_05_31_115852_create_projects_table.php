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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('logo');
            $table->text('description')->nullable();
            $table->text('goals')->nullable();
            $table->json('requirement_documents')->nullable(); 
            $table->json('skills_required')->nullable(); 
            $table->string('project_url')->nullable();
            $table->integer('is_private');
            $table->unsignedBigInteger('owner_id'); 
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
