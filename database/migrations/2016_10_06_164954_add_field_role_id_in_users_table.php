<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldRoleIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->string('avatar',50)->nullable();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

        });

        \DB::table('users')->insert([
            'role_id'=>1,
            'name'=>'Super Admin',
            'email'=>'admin@admin.com',
            'password'=>\Hash::make('admin'),
            'avatar'=>'user.png',
            'created_at'=>date("Y-m-d H:i:s"),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('role_id_users_foreign');
            $table->dropColumn('role_id','avatar');
        });
    }
}
