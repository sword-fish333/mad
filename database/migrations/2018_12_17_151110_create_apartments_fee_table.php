<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments_fee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',190);
            $table->text('description');
            $table->double('value');
            $table->string('type_of_value');
            $table->unsignedInteger('apartment_id');
            $table->timestamps();

            $table->foreign('apartment_id')->references('id')->on('apartments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments_fee');
    }
}
