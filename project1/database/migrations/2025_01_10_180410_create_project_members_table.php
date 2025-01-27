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
        Schema::create('project_members', function (Blueprint $table) {
            $table->id('project_member_id');
            $table->foreignId('project_id')->constrained('grant_projects');  
            $table->foreignId('academician_id')->constrained('academicians');
            $table->string('role');
            $table->timestamps();

            $table->unique(['project_id', 'academician_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};
