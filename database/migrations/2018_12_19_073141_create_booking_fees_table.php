<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',190);
            $table->text('description');
            $table->unsignedDecimal('value');
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
        Schema::dropIfExists('booking_fees');
    }
}
