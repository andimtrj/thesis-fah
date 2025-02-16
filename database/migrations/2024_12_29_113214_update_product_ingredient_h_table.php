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
        Schema::table('product_ingredient_h', function(Blueprint $table){
            // Drop the foreign key constraint first (if it exists)
            $table->dropColumn('product_id'); // This will only run if the foreign key exists


            // Change the column to a foreign key constraint
            $table->foreignId('product_id')->constrained('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_ingredient_h', function(Blueprint $table){
            // Remove the foreign key constraint in the down method
            if (Schema::hasColumn('product_ingredient_h', 'product_id')) {
                $table->dropForeign(['product_id']);
            }

            // Revert the column back to its original form
            $table->bigInteger('product_id');
        });
    }
};
