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
    Schema::create('packages', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // misal: Paket Adat Lengkap
        $table->text('description')->nullable();
        $table->decimal('price', 12, 2); // harga paket (biasanya lebih murah dari jumlah satuan)
        $table->string('image')->nullable();
        $table->enum('status', ['available', 'inactive'])->default('available');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
