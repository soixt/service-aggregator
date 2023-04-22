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
        Schema::create('sms_process_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_project_active_service_id');
            $table->string('country_id');
            $table->string('project_id');
            $table->string('phone_number');
            $table->string('type');
            $table->text('message');
            $table->string('status');
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
        Schema::dropIfExists('sms_service');
    }
};
