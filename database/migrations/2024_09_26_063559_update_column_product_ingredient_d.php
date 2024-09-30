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
        Schema::table('product_ingredient_d', function(Blueprint $table){
            $table->dropColumn('prod_ing_d_no');
            $table->renameColumn('prod_ing_h_no', 'prod_ing_h_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_ingredient_d', function(Blueprint $table){
            $table->string('prod_ing_d_no')->unique();
            $table->renameColumn('prod_ing_h_id', 'prod_ing_h_no');
        });
    }
};
