<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklinksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backlinks', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('linksource')->nullable();
            $table->string('linktarget')->nullable();
            $table->string('linktext')->nullable();
            $table->string('relation')->nullable();
            $table->integer('found')->default(1);
            $table->integer('status')->default(200);
            $table->integer('project_id')->unsigned();
            $table->text('note')->nullable();
            $table->dateTime('checked_at');
            $table->timestamps();
        });

        Schema::table('backlinks', function (Blueprint $table)
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
        Schema::table('backlinks', function (Blueprint $table)
        {
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('backlinks');
    }

}
