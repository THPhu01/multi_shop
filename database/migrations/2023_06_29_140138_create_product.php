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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->text('desc');
            $table->text('content');
            $table->decimal('price', 10, 0);
            $table->decimal('price_sale', 10, 0)->nullable();
            $table->integer('percent')->nullable();
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->string('qty');
            $table->string('sold')->default(0);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
