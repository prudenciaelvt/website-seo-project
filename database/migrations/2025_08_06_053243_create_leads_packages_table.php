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
        Schema::create('leads_packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('alamat_usaha');
            $table->string('email');
            $table->string('nama_pemilik');
            $table->string('nomor_telepon');
            $table->string('produk')->nullable();
            $table->string('komisi');
            $table->boolean('setuju');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_packages');
    }
};
