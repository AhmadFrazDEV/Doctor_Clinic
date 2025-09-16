<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClinicIdAndRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('clinic_id')->nullable()->after('email');
            $table->enum('role', ['super_admin', 'clinic_owner', 'doctor', 'staff'])->default('staff')->after('clinic_id');

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['clinic_id']);
            $table->dropColumn(['clinic_id', 'role']);
        });
    }
}
