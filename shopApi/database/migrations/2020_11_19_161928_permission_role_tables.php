<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermissionRoleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles',function (Blueprint $table){
           $table->id('id') ;
           $table->string('name')->unique() ;
           $table->string('title')->nullable() ;
           $table->string('description')->nullable();
           $table->boolean('deletable')->default(true);
           $table->timestamps();
        });


        Schema::create('permissions',function (Blueprint $table){
            $table->id('id') ;
            $table->string('name')->unique() ;
            $table->string('title')->nullable() ;
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('role_user',function (Blueprint $table){
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['role_id','user_id']);
        });

        Schema::create('permission_role',function (Blueprint $table){
            $table->unsignedBigInteger('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');

    }
}
