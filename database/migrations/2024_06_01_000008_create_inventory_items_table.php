<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id');
            $table->string('name');
            $table->string('category');
            $table->integer('available_quantity');
            $table->integer('min_threshold');
            $table->decimal('unit_price', 10, 2);
            $table->string('supplier')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('last_updated_by');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
}
