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
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->unsignedInteger('languages_id');
            $table->string('id_document_picture', 145)->nullable();
            $table->unsignedInteger('persons_id');
            $table->tinyInteger('status')->nullable();
            $table->text('token')->nullable();

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
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('persons_id', 'fk_reservations_persons1_idx')
                ->references('id')->on('persons')
                ->onDelete('no action')
                ->onUpdate('no action');
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
