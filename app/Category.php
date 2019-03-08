<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
  // public function user() {
  //   return $this->belongsTo('App\User');
  // }
    // public function post() {
    //   return $this->belongsTo('App\Post');
    // }

    // protected $table = 'categories';
    public function posts() {
      return $this->hasMany('App\Post');
    }

}
