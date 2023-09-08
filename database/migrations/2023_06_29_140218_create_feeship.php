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
        Schema::create('feeship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_matp')->unsigned();
            $table->unsignedBigInteger('id_maqh')->unsigned();
            $table->unsignedBigInteger('id_xa')->unsigned();
            $table->string('feeship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeship');
    }
};
