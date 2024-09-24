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
        Schema::create('metric_groups', function (Blueprint $table) {
            $table->id();
            $table->string('metric_grp_code')->unique();
            $table->string('metric_grp_name');
            $table->integer('base_metric_seq_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metric_groups');
    }
};
