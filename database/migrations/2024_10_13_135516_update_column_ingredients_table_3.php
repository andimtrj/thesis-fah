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
        Schema::table('ingredients', function(Blueprint $table){
            $table->renameColumn('ingredient_amt', 'initial_amt');
            $table->renameColumn('metric_id', 'initial_metric_id');
            $table->foreignId('curr_metric_id')->constrained('metrics');
            $table->decimal('curr_amt', 17, 2);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function(Blueprint $table){
            $table->renameColumn('initial_amt', 'ingredient_amt');
            $table->renameColumn('initial_metric_id', 'metric_id');
            $table->dropForeign(['curr_metric_id']);
            $table->dropColumn('curr_metric_id');
            $table->dropColumn('curr_amt');

        });
    }
};
