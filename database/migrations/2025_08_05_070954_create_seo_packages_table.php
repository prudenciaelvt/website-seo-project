<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('seo_packages', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }
    public function up(): void
    {
        Schema::create('seo_packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('website_usaha');
            $table->string('nama_pemilik');
            $table->string('nomor_telepon')->nullable();
            $table->string('jangka_waktu');
            $table->string('produk')->nullable();
            $table->string('target_market')->nullable();
            $table->boolean('setuju');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_packages');
    }
};
