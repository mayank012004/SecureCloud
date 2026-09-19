<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('event_type');

            $table->string('description');

            $table->string('ip_address')
                ->nullable();

            $table->string('user_agent')
                ->nullable();

            $table->string('risk_level')
                ->default('low');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_events');
    }
};
