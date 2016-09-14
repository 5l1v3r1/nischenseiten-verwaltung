<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->integer('project_id')->unsigned();
            $table->text('note')->nullable();
            $table->integer('power')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('competitions', function (Blueprint $table)
        {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions', function (Blueprint $table)
        {
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('competitions');
    }

}
