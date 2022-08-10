<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->index();
            $table->uuid('company_id')->index();
            $table->uuid('rider_id')->index()->nullable();
            $table->string('orderCode');
            $table->double('total', 20,4)->default(0.00);
            $table->double('shipping_charge', 20,4)->default(0.00);
            $table->bigInteger('discount')->default(0);
            $table->boolean('rider_assigned')->default(0);
            $table->boolean('company_accepted')->default(0);
            $table->enum('payment_status', ['PAID', 'PENDING', 'FAILED'])->default('PENDING');
            $table->enum('delivery_status', ['DELIVERED', 'PENDING', 'ASSIGNED', 'IN-TRANSIT', 'REJECTED', 'WAITING', 'RETURNED'])->default('PENDING');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
