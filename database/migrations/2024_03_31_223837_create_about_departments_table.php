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
        Schema::create('about_departments', function (Blueprint $table) {
            $table->id();
            $table->string('about_slug')->unique();
            $table->string('name');
            $table->text('about_desc')->nullable();
            $table->string('upload')->nullable();
            $table->foreignId('dept_id')->default(0)->constrained('departments')->onDelete('cascade');
            $table->integer('about_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_departments');
    }
};
