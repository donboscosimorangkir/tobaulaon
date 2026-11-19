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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // misal: Pemasangan Sortali, Dekorasi Pelaminan
        $table->text('description')->nullable();
        $table->decimal('price', 12, 2);
        $table->string('unit')->default('per_acara'); // per_acara, per_jam, per_hari
        $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
        $table->enum('status', ['available', 'inactive'])->default('available');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
