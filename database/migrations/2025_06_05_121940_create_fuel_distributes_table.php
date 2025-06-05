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
        Schema::create('fuel_distributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuel_request_id')->nullable()->constrained('fuel_requests')->onDelete('set null');

            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('total_km_covered_by_vehicle')->nullable();
            $table->foreignId('fuel_id')->nullable()->constrained()->onDelete('restrict');
            $table->decimal('amount', 8, 2);
            $table->dateTime('date');
            $table->foreignId('station_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('service_reason_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('requested_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('provider_user_id')->constrained('users')->onDelete('restrict');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_distributes');
    }
};
