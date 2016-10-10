<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->timestamps();

            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('action_id')
                ->references('id')
                ->on('actions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_actions' , function(Blueprint $table){
            $table->dropForeign('menu_actions_action_id_foreign','menu_actions_menu_id_foreign');
        });
        Schema::drop('menu_actions');
    }
}
