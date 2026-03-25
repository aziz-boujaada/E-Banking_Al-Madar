<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('transfer_id')->nullable()->constrained('transfers')->nullOnDelete();
            $table->enum('type', ['DEBIT', 'CREDIT', 'FEE', 'FEE_FAILED', 'INTEREST', 'TRANSFER_OUT', 'TRANSFER_IN']);
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('MAD');
            $table->text('description')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
