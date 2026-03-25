<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->enum('type', ['COURANT', 'EPARGNE', 'MINEUR']);
            $table->enum('status', ['ACTIVE', 'BLOCKED', 'CLOSED'])->default('ACTIVE');
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('overdraft_limit', 15, 2)->default(0);
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->decimal('daily_limit', 15, 2)->default(10000);
            $table->text('blocked_reason')->nullable();
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('guardian_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
