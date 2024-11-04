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
        Schema::dropIfExists('transaction_d_alloc');
        Schema::dropIfExists('transaction_d');
        Schema::dropIfExists('transaction_h');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('transaction_h', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_type_id')->constrained();
            $table->string('trx_h_no')->unique();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('user_create_id')->constrained(
                table:'users', indexName:'transaction_h_users_id'
            );
            $table->timestamp('trx_date');
            $table->timestamps();
        });

        Schema::create('transaction_d', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->decimal('product_amt');
            $table->string('product_name');
            $table->string('notes');
            $table->foreignId('transaction_h_id')->constrained(
                table:'transaction_h'
            );
            $table->timestamps();
        });

        Schema::create('transaction_d_alloc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained();
            $table->foreignId('transaction_d_id')->constrained(
                table:'transaction_d'
            );
            $table->decimal('ingredient_amt');
            $table->string('ingredient_name');
            $table->timestamps();
        });

    }
};
