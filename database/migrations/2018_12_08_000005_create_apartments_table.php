<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'apartments';

    /**
     * Run the migrations.
     * @table apartments
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('surface', 190)->nullable();
            $table->string('location', 190)->nullable();
            $table->text('description')->nullable();
            $table->integer('stars')->nullable();
            $table->double('price')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->double('increment_price')->nullable();
            $table->string('kind_increment_price', 45)->nullable();

            $table->unique(["id"], 'id_UNIQUE');
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
