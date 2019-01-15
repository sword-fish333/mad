<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'reservations';

    /**
     * Run the migrations.
     * @table reservations
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('apartment_id');
            $table->string('name', 190)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('phone', 190)->nullable();
            $table->text('address')->nullable();
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->unsignedInteger('guests_nr')->nullable();
            $table->string('card_name',255)->nullable();
            $table->string('card_nr',255)->nullable();
            $table->string('card_expire_date',255)->nullable();
            $table->string('card_secure_code',255)->nullable();
            $table->string('type_of_card',255)->nullable();
            $table->string('payment_status',190)->nullable();
            $table->dateTime('schedule_check_in')->nullable();
            $table->dateTime('schedule_check_out')->nullable();
            $table->unsignedInteger('languages_id')->nullable();
            $table->unsignedInteger('persons_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('newsletter')->nullable();

            $table->text('token')->nullable();
            $table->unsignedInteger('caretaker_id')->nullable();
            $table->index(["apartment_id"], 'fk_reservations_apartments1_idx');

            $table->index(["languages_id"], 'fk_reservations_languages1_idx');

            $table->index(["persons_id"], 'fk_reservations_persons1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('apartment_id', 'fk_reservations_apartments1_idx')
                ->references('id')->on('apartments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('languages_id', 'fk_reservations_languages1_idx')
                ->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('caretaker_id')
                ->references('id')->on('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('persons_id', 'fk_reservations_persons1_idx')
                ->references('id')->on('persons')
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
