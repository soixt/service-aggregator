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
        Schema::create('payment_process_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_order_service_id');
            $table->string('status');
            $table->float('amount');
            $table->string('type');
            $table->json('metadata');
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
        Schema::dropIfExists('payment_process_service');
    }
};
