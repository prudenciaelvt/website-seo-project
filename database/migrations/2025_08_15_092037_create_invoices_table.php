<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('client')->nullable();

            // Paket utama
            $table->string('paket1_produk')->nullable();
            $table->unsignedInteger('paket1_qty')->nullable();
            $table->decimal('paket1_harga', 15, 2)->nullable();
            $table->decimal('paket1_total', 15, 2)->nullable();

            // Paket tambahan (JSON)
            $table->json('paket_tambahan')->nullable();

            // Total
            $table->decimal('total_sebelum', 15, 2)->nullable();
            $table->decimal('grand_total', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
