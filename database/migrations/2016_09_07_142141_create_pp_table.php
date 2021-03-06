<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_programs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('notes')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });


        Schema::table('partner_programs', function (Blueprint $table)
        {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_programs', function (Blueprint $table)
        {
            $table->dropForeign(['user_id']);
        });

        Schema::drop('partner_programs');
    }

}
