<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDeliveryManTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_deliveryMan', function (Blueprint $table) {
            $table->increments('deliveryMan_id');
            $table->string('deliveryMan_name');
            $table->string('deliveryMan_address');
            $table->string('deliveryMan_contactno');
            $table->string('deliveryMan_image');
            $table->string('deliveryMan_email');
            $table->string('deliveryMan_password');
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
        Schema::dropIfExists('tbl_deliveryMan');
    }
}
