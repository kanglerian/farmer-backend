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
        Schema::create('detail_maintenance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_maintenance');
            $table->string('detail', 150);
            $table->float('cost');
            $table->foreign('id_maintenance')->references('id')->on('maintenances')->onDelete('restrict');
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
        Schema::dropIfExists('detail_maintenance');
    }
};
