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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->string('milestone_id')->unique();
            $table->string('project_id');
            $table->string('name');
            $table->string('target_completion_date');
            $table->string('deliverable');
            $table->string('status');
            $table->string('remark');
            $table->string('last_updated');
            $table->timestamps();

            //$table->foreign('project_id')->references('project_id')->on('grant_projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
