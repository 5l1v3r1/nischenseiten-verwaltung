<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('deadline')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('project_id')->unsigned();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('notes', function (Blueprint $table)
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
        Schema::table('notes', function (Blueprint $table)
        {
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('notes');
    }

}
