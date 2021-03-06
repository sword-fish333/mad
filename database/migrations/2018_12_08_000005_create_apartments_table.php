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
            $table->string('name', 190)->nullable();
            $table->string('surface', 190)->nullable();
            $table->string('location', 190)->nullable();
            $table->string('status', 190)->nullable();
            $table->text('description')->nullable();
            $table->integer('stars')->nullable();
            $table->double('price')->nullable();
            $table->unsignedInteger('floor')->nullable();
            $table->unsignedInteger('bedrooms')->nullable();
            $table->unsignedInteger('bathrooms')->nullable();
            $table->boolean('elevator')->nullable();
            $table->unsignedInteger('nr_single_beds')->nullable();
            $table->unsignedInteger('nr_double_beds')->nullable();
            $table->unsignedInteger('nr_guests')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->double('increment_price')->nullable();
            $table->string('kind_increment_price', 45)->nullable();
            $table->unsignedInteger('holder_id')->nullable();
            $table->unique(["id"], 'id_UNIQUE');

            $table->foreign('holder_id')->references('id')->on('apartments_holders')
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
