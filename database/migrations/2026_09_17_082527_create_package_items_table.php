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
    Schema::create('package_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained()->cascadeOnDelete();
        $table->string('itemable_type'); // App\Models\Product atau App\Models\Service
        $table->unsignedBigInteger('itemable_id');
        $table->integer('quantity')->default(1);
        $table->timestamps();

        $table->index(['itemable_type', 'itemable_id']);
    });
}
    public function down(): void
    {
        Schema::dropIfExists('package_items');
    }
};
