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
        Schema::table('purchase_trx_d', function(Blueprint $table){
            $table->foreignId('metric_id')->constrained('metrics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_trx_d', function(Blueprint $table){
            $table->dropForeign(['metric_id']);
            $table->dropColumn('metric_id');
        });
    }
};
