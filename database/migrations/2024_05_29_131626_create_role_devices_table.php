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
        Schema::create('role_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_device_master');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_device_master')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('role_devices');
    }
};
