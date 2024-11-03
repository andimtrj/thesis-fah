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
        Schema::table('product_categories', function(Blueprint $table){
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('tenant_id')->constrained('tenants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function(Blueprint $table){
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};
