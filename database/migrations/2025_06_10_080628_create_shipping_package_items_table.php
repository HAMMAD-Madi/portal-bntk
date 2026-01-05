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
        Schema::create('shipping_package_items', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('shipping_package_id')->constrained()->onDelete('cascade');
            $table->string('gtin');
            $table->integer('quantity');
            $table->string('condition')->default('new');
            $table->timestamps();
            //soft delete column
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_package_items');
    }
};
