<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('msg_id_wpp')->nullable();
            $table->string('direction', 20);
            $table->text('message')->nullable();
            $table->foreignId('instance_id');
            $table->string('phone_id_wpp');
            $table->integer('status')->default(0);
            $table->string('type');
            $table->string('media_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
