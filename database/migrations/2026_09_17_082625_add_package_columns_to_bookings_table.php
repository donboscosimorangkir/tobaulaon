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
    Schema::table('bookings', function (Blueprint $table) {
        $table->foreignId('package_id')->nullable()->after('customer_id')->constrained()->nullOnDelete();
        $table->decimal('estimated_price', 12, 2)->nullable()->after('total_price');
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropForeign(['package_id']);
        $table->dropColumn(['package_id', 'estimated_price']);
    });
}
};
