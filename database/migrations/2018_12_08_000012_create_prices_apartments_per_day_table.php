<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesApartmentsPerDayTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'prices_apartments_per_day';

    /**
     * Run the migrations.
     * @table prices_apartments_per_day
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('datetime')->nullable();
            $table->float('value')->nullable();
            $table->unsignedInteger('apartments_id');

            $table->index(["apartments_id"], 'fk_prices_apartments_per_day_apartments1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('apartments_id', 'fk_prices_apartments_per_day_apartments1_idx')
                ->references('id')->on('apartments')
                ->onDelete('no action')
                ->onUpdate('no action');
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
