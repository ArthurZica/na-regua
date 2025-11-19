<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheduled_messages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('category');
            $table->text('text')->nullable();
            $table->string('media_url')->nullable();
            $table->foreignId('customer_id');
            $table->foreignId('empresa_id');
            $table->timestamp('scheduled_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_messages');
    }
};
