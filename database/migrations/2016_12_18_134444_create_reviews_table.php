<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hosting_type')->default('github');
            $table->string('repository_url');
            $table->unsignedMediumInteger('number');
            $table->string('title');
            $table->unsignedInteger('author_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->unique(['hosting_type', 'repository_url', 'number']);
            // $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
