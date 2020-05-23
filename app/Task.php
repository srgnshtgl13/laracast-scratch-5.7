<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];
	
	// a task can have only one project
    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function complete($completed=true){
    	$this->update(['completed'=>$completed]);
    }

    public function incomplete(){
    	$this->complete(false);
    }
}
