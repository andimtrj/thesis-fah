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
        Schema::table('metrics', function(Blueprint $table){
            $table->foreignId('created_by')->change()->constrained('users');
            $table->foreignId('updated_by')->change()->constrained('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metrics', function(Blueprint $table){
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });

    }
};
