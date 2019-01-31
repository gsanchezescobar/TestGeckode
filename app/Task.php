<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'task';

    protected $fillable = ['name','description','done','created_at'];

    protected $casts = [
        'created_at' => 'datetime:d-F/Y',
    ];

    public function subtask(){
        return $this->hasMany(Subtask::class,'task','id');
    }
}
