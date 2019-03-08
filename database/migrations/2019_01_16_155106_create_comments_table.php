<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
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
          ->table('comments', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('post_id');
            //$collection->foreign('post_id')->references('id')->on('posts');
            $collection->integer('user_id');
            //$collection->foreign('user_id')->references('id')->on('users');
            $collection->text('comment');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('comments');
        Schema::connection($this->connection)
        ->table('comments', function (Blueprint $collection)
        {
          $collection->drop();
        });
    }
}
