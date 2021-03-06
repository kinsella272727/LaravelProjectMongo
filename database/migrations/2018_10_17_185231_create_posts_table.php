<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
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
        ->table('posts', function (Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('title');
            $collection->mediumText('body');
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
      Schema::connection($this->connection)
        ->table('posts', function (Blueprint $collection) 
        {
            $collection->drop();
        });


    }
}
