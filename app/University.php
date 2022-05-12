<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
   public function departments() {
       return $this->hasMany(Department::class);
   }
}
