<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @link https://en.wikipedia.org/wiki/Subdivisions_of_Vietnam
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer__addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->comment('Country ID');
            $table->unsignedBigInteger('zone_level_1')->nullable()->comment('Province/Municipality ID');
            $table->unsignedBigInteger('zone_level_2')->nullable()->comment('County/District ID');
            $table->unsignedBigInteger('zone_level_3')->nullable()->comment('Ward/Commune ID');
            $table->string('street')->nullable()->comment('Street Address');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer__customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer__addresses');
    }
}
