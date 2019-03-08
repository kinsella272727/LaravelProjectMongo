<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function post() {
    return $this->belongsTo('App\Post');
  }

}
