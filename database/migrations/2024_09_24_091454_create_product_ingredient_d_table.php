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
        Schema::create('product_ingredient_d', function (Blueprint $table) {
            $table->id();
            $table->string('prod_ing_d_no')->unique();
            $table->foreignId('prod_ing_h_no')->constrained(
                table:'product_ingredient_h', indexName:'prod_ing_d_prod_ing_h_id'
            );
            $table->foreignId('ingredient_id')->constrained();
            $table->decimal('ingredient_amt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_ingredient_d');
    }
};
