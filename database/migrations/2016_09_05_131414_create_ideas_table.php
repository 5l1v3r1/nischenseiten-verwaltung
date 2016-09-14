<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('searchvolume')->default(0);
            $table->double('cpc', 5, 2)->default(0);
            $table->double('provision', 5, 2)->default(0);
            $table->double('price_per_product', 10, 2)->default(0);
            $table->double('buy_conversion', 5, 2)->default(0);
            $table->integer('partner_program_id')->unsigned()->nullable();
            $table->integer('idea_category_id')->unsigned()->nullable();
            $table->integer('seasonal')->default(0);
            $table->text('keywords')->nullable();
            $table->text('domains')->nullable();
            $table->text('competition')->nullable();
            $table->string('competition_power')->nullable();
            $table->integer('ranking')->nullable();
            $table->text('notes')->nullable();
            $table->text('w_questions')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('ideas', function (Blueprint $table)
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
        Schema::table('ideas', function (Blueprint $table)
        {
            $table->dropForeign(['user_id']);
        });
        Schema::drop('ideas');
    }

}
