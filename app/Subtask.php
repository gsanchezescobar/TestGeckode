<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    //
    protected $table = 'subtask';

    protected $fillable = ['name','description','done','created_at','task'];

    public function task(){
        return $this->belongsTo(Task::class,'id','task');
    }
}
