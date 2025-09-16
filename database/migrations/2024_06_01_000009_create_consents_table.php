<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('document_type');
            $table->enum('status', ['pending', 'signed'])->default('pending');
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consents');
    }
}
