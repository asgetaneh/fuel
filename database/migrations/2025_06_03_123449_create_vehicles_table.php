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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->foreignId('vehicle_type_id')->constrained()->onDelete('cascade');
            $table->string('registration_number');
            $table->string('engine_number');
            $table->integer('total_seat');
            $table->text('description')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
