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
        Schema::create('adjustment_trx_d', function (Blueprint $table) {
            $table->id();
            $table->decimal('ingredient_amt');
            $table->string('ingredient_name');
            $table->string('notes');
            $table->foreignId('adjustment_trx_h_id')->constrained(
                table:'adjustment_trx_h'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustment_trx_d');
    }
};
