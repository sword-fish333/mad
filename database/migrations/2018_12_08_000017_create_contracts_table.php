<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contracts';

    /**
     * Run the migrations.
     * @table contracts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('filename', 145)->nullable();
            $table->unsignedInteger('reservations_id');

            $table->index(["reservations_id"], 'fk_contracts_reservations1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('reservations_id', 'fk_contracts_reservations1_idx')
                ->references('id')->on('reservations')
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
