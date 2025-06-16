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
        Schema::create('project_teams', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('team_lead_id'); // Foreign key to users
            $table->unsignedBigInteger('project_id');   // Foreign key to projects

            $table->softDeletes(); // deleted_at
            $table->timestamps();  // created_at, updated_at

            // Foreign key constraints
            $table->foreign('team_lead_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_teams');
    }
};
