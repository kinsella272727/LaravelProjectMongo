<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Post extends Eloquent
{
    //Table name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = '_id';
    //TimeStamp
    public $timestamps = true;


    public function user() {
      return $this->belongsTo('App\User');
    }

    public function comments() {
      return $this->hasMany('App\Comment');
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function tags()
    {
      return $this->belongsToMany('App\Tag');
    }
}
