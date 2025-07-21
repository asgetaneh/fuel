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
        Schema::create('fuel_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->integer('total_km_covered_by_vehicle')->nullable();
            $table->foreignId('fuel_id')->constrained()->onDelete('restrict');
            $table->decimal('amount', 8, 2);
            $table->dateTime('date');
           // $table->foreignId('station_id')->constrained()->onDelete('restrict');
            $table->foreignId('service_reason_id')->constrained('fuel_request_reasons')->onDelete('restrict');
            $table->foreignId('requested_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('status')->default(1); // 0: pending, 1: approved, 2,: fullfilled, 3: rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_requests');
    }
};
