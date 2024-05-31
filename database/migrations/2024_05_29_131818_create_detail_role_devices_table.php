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
        Schema::create('detail_role_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sub_device');
            $table->string('status');
            $table->foreign('id_sub_device')->references('id')->on('devices')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_role_devices');
    }
};