<?php

use App\Enums\Payments\PaymentOrderService;
use App\Enums\Payments\PaymentStatus;
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
        Schema::create('payment_order_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('provider_project_active_service_id');
            $table->string(PaymentOrderService::CURRENCY);
            $table->float(PaymentOrderService::AMOUNT);
            $table->string(PaymentOrderService::CLIENT_REFERENCE);
            $table->string(PaymentOrderService::PROVIDER_REFERENCE)->nullable();
            $table->string(PaymentOrderService::STATUS)->default(PaymentStatus::INIT);
            $table->string(PaymentOrderService::DESCRIPTION);
            $table->json(PaymentOrderService::CUSTOMER_INFO);
            $table->json(PaymentOrderService::METADATA);
            $table->json(PaymentOrderService::ADDITIONAL_DATA)->nullable();
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
        Schema::dropIfExists('payment_order_service');
    }
};
