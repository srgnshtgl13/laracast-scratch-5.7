<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class CompletedTasksController extends Controller
{
		/* ENCAPSULATION */
    	// Encapsulation: Hide internal and values inside a class

    	// this method will hit the Task Model 'complete' method
    public function store(Task $task){
    	$task->complete();
    	return ["message"=>"completed"];
    }
    	// this method will hit the Task Model 'incomplete' method
    public function destroy(Task $task){
    	$task->incomplete();
    	return ["message"=>"incompleted"];
    }
    	
}
