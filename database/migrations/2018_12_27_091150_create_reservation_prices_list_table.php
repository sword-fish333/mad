<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationPricesListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_prices_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',190);
            $table->text('description')->nullable();
            $table->unsignedDecimal('price');
            $table->unsignedDecimal('value')->nullable();
            $table->string('type_of_value',190)->nullable();
            $table->dateTime('day');
            $table->unsignedInteger('reservation_id');

            $table->foreign('reservation_id')
                ->references('id')->on('reservations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('reservation_prices_list');
    }
}
