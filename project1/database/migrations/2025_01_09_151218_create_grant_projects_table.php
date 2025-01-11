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
        Schema::create('grant_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->foreignId('academician_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->decimal('grant_amount');
            $table->string('grant_provider');
            $table->string('start_date');
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grant_projects');
    }
};
