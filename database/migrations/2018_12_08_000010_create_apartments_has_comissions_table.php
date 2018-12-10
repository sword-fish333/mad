<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsHasComissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'apartments_has_comissions';

    /**
     * Run the migrations.
     * @table apartments_has_comissions
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('commissions_id');
            $table->unsignedInteger('apartments_id');

            $table->index(["apartments_id"], 'fk_commissions_has_apartments_apartments1_idx');

            $table->index(["commissions_id"], 'fk_commissions_has_apartments_commissions1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('commissions_id', 'fk_commissions_has_apartments_commissions1_idx')
                ->references('id')->on('commissions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('apartments_id', 'fk_commissions_has_apartments_apartments1_idx')
                ->references('id')->on('apartments')
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
