<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function board(){
        return $this->belongsTo(Board::class);
    }

    public function taskstatus(){
        return $this->hasMany(TaskStatus::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
