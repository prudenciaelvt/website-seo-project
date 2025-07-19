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
       Schema::create('admins', function (Blueprint $table) {
           $table->id();
           $table->string('name'); // Add name field
           $table->string('email')->unique(); // Add email field
           $table->string('password'); // Add password field
           $table->timestamps();
       });
   }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
