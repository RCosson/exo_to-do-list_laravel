<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Task;

class Task extends Model
{
  public function post()
    {
        return $this->belongsTo('App\Category');
    }
}
