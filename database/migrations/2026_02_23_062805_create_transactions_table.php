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

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nama');
            $table->bigInteger('nominal');

            $table->enum('tipe', ['pemasukan', 'pengeluaran']);

            $table->unsignedBigInteger('category_id')->nullable(); 
            // TANPA constrained dulu

            $table->date('tanggal');
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};