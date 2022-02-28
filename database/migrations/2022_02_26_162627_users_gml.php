<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersGml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_gml', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name_user');
            $table->string('surname_user');
            $table->string('identification_user');
            $table->string('email_user');
            $table->string('country_user');
            $table->string('movil_user')->nullable();
            $table->string('address_user')->nullable();
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id_category')->on('categories_gml');
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
        Schema::table('users_gml', function (Blueprint $table) {
            //
        });
    }
}
