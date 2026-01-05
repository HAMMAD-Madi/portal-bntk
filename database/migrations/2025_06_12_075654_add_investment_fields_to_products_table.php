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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_investment')->default(false);
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('expected_list_date')->nullable();
            $table->decimal('target_price', 10, 2)->nullable();
            $table->string('investment_notes')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'is_investment',
                'purchase_price',
                'purchase_date',
                'expected_list_date',
                'target_price',
                'investment_notes'
            ]);
        });
    }
};
