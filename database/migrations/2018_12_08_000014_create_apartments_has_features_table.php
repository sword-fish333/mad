<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsHasFeaturesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'apartments_has_features';

    /**
     * Run the migrations.
     * @table apartments_has_features
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('apartments_id');
            $table->unsignedInteger('features_id');

            $table->index(["apartments_id"], 'fk_apartments_has_features_apartments1_idx');

            $table->index(["features_id"], 'fk_apartments_has_features_features1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('apartments_id', 'fk_apartments_has_features_apartments1_idx')
                ->references('id')->on('apartments')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('features_id', 'fk_apartments_has_features_features1_idx')
                ->references('id')->on('features')
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
