<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairCostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'repair_costs';

    /**
     * Run the migrations.
     * @table repair_costs
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 190)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('repair_date')->nullable();
            $table->double('value')->nullable();
            $table->unsignedInteger('apartments_id');

            $table->index(["apartments_id"], 'fk_repair_costs_apartments1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('apartments_id', 'fk_repair_costs_apartments1_idx')
                ->references('id')->on('apartments')
                ->onDelete(' cascade')
                ->onUpdate(' cascade');

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
