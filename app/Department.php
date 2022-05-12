<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function university() {
        return $this->belongsTo(University::class);
    }
    
    public function courses() {
        return $this->hasMany(Course::class);
    }
}
