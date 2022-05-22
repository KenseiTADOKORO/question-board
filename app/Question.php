<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'content', 'course_id', 'department_id', 'university_id'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
