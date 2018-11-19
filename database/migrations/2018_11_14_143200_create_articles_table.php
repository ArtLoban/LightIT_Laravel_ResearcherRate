<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('journal_id')->unsigned()->index();
            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
            $table->integer('publication_type_id')->unsigned()->index();
            $table->foreign('publication_type_id')->references('id')->on('publication_types')->onDelete('cascade');
            $table->integer('journal_number');
            $table->integer('year');
            $table->string('pages');
            $table->string('language');
            $table->text('description')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
