<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
{
  Schema::create('project_requests', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('body');
        $table->unsignedBigInteger('project_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('target_id');
        $table->enum('request_type', ['user_request', 'owner_request']);
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        $table->timestamps();

        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
