<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('project_id')->unsigned();
            $table->text('note')->nullable();
            $table->integer('searchvolume')->default(0);
            $table->double('cpc', 5, 2)->default(0);
            $table->double('competition', 5, 2)->default(0);
            $table->integer('position')->default(0);
            $table->integer('has_content')->default(0);
            $table->timestamps();
        });

        Schema::table('keywords', function (Blueprint $table)
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
        Schema::table('keywords', function (Blueprint $table)
        {
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('keywords');
    }

}
