<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'invoices';

    /**
     * Run the migrations.
     * @table invoices
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 145)->nullable();
            $table->string('type', 145)->nullable();
            $table->unsignedInteger('reservations_id');

            $table->index(["reservations_id"], 'fk_invoices_reservations1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('reservations_id', 'fk_invoices_reservations1_idx')
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
