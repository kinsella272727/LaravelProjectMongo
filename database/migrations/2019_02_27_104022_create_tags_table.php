<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
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
          ->table('tags', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('name');
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
        //Schema::dropIfExists('tags');
        Schema::connection($this->connection)
          ->table('tags', function (Blueprint $collection)
          {
              $collection->drop();
          });
    }
}
