<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',10)->index();
            $table->string('action',100);
            $table->timestamps();
        });

        $data = [
            [
                'code'=>'index',
                'action'=>'Index',
            ],
            [
                'code'=>'create',
                'action'=>'Create',
            ],
            [
                'code'=>'update',
                'action'=>'Update',
            ],
            [
                'code'=>'delete',
                'action'=>'Delete',
            ],
            [
                'code'=>'publish',
                'action'=>'Publish',
            ],
            [
                'code'=>'view',
                'action'=>'View',
            ],
        ];

        \DB::table('actions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actions');
    }
}
