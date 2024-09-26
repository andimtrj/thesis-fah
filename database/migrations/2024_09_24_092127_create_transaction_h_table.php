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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_h');
    }
};
