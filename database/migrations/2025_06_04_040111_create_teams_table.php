<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->foreignId('team_lead_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
        $table->softDeletes(); 
        $table->timestamps();  
    });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
