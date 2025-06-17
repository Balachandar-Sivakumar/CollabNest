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
    Schema::create('project_invites', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('owner_id');
        $table->unsignedBigInteger('project_id');
        $table->string('email');
        $table->unsignedBigInteger('target_user_id')->nullable();
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
