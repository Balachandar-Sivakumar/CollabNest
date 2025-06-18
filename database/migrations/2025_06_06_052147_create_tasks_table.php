<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('tasks', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
    $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
    $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
    $table->date('due_date')->nullable();
    $table->enum('status', [
        'todo', 
        'in_progress', 
        'testing', 
        'completed', 
        'on_hold', 
        'cancelled'
    ])->default('todo');
    $table->string('requirement_document')->nullable();
    $table->json('images')->nullable();
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
