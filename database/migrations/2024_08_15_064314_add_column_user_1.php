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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 16)->after('remember_token');
            $table->string('first_name', 128)->after('phone_number');
            $table->string('last_name', 128)->after('first_name');
            $table->integer('role_id')->after('last_name');
            $table->integer('tenant_id')->after('role_id');
            $table->integer('branch_id')->after('tenant_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('role_id');
            $table->dropColumn('tenant_id');
            $table->dropColumn('branch_id');
        });

    }
};
