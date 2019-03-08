<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     protected $connection = 'mongodb';

    public function up()
    {
        Schema::connection($this->connection)
          ->table('post_tag', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('post_id')->unsigned();
            $collection->foreign('post_id')->references('id')->on('posts');
            $collection->integer('tag_id')->unsigned();
            $collection->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('post_tag');
        Schema::connection($this->connection)
          ->table('post_tag', function (Blueprint $collection)
          {
              $collection->drop();
          });
    }
}
