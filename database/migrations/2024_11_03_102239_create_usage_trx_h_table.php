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
        Schema::create('usage_trx_h', function (Blueprint $table) {
            $table->id();
            $table->string('usage_trx_no')->unique();
            $table->foreignId('transaction_type_id')->constrained('transaction_types');
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->foreignId('user_create_id')->constrained(
                table:'users', indexName:'usage_trx_h_users_id'
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
        Schema::dropIfExists('usage_trx_h');
    }
};
