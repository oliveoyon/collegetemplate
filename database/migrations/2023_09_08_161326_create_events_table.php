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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_title', 200);
            $table->text('event_description')->nullable();
            $table->string('event_type', 10);
            $table->string('upload', 50);
            $table->string('start_date', 50);
            $table->string('end_date', 200);
            $table->string('url', 200);
            $table->integer('event_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
