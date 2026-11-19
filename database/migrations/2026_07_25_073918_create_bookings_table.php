<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); // SRT-20260705-001
        $table->foreignId('customer_id')->constrained();
        $table->date('event_date');
        $table->date('pickup_date');
        $table->date('return_date');
        $table->enum('status', ['pending', 'confirmed', 'picked_up', 'returned', 'cancelled'])->default('pending');
        $table->decimal('total_price', 10, 2)->default(0);
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
