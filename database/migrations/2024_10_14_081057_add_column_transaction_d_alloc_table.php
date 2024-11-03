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
        Schema::table('transaction_d_alloc', function(Blueprint $table){
            $table->decimal('ingredient_amt', 17, 2)->change();
            $table->foreignId('metric_id')->constrained('metrics');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_d_alloc', function(Blueprint $table){
            $table->decimal('ingredient_amt', 8, 2)->change();
            $table->dropForeign(['metric_id']);
            $table->dropColumn('metric_id');
        });

    }
};
