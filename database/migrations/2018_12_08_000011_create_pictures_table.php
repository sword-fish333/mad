<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'pictures';

    /**
     * Run the migrations.
     * @table pictures
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
            $table->unsignedInteger('apartments_id');

            $table->index(["apartments_id"], 'fk_pictures_apartments1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('apartments_id', 'fk_pictures_apartments1_idx')
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
