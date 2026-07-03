<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Sesi Masak Baru');
            $table->timestamps();
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('chat_sessions')->cascadeOnDelete();
            $table->enum('role', ['user', 'assistant', 'system']);
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_sessions');
    }
};
