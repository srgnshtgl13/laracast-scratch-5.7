<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTaskController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth')->except(['get']);
    }*/
    
    public function get(Project $project){
    	$tasks = Task::where('project_id',$project->id)->get();
    	return $tasks;
    }

    public function store(Project $project){
    	$attributes=request()->validate([
            'description' => 'required',
        ]);

    	$project->addTask($attributes); // this method will hit the Project Model
  
        return ['message'=>"Task was created in successfully!"];
    }

	/**
	 * Update a task to complete or to otherwise
	 */
    public function update(Task $task){
    	/*$task->update([
    		'completed'=>request('completed')
    	]);*/
    	//instead of doing like above we can do encapsulation like below

    	/* ENCAPSULATION */
    	// Encapsulation: Hide internal and values inside a class

    	// Way 1 // if we do that we don't need to create another method in Task Model
    	// $task->complete(request('completed'));	// this will hit the Task model
    	// Way 2
    	//request('completed') ? $task->complete() : $task->incomplete(); // we dont pass the completed arguments inside complete because it is true as default
    	// Way 3
    	$method = request('completed') ? 'complete' : 'incomplete';
    	$task->$method();


    	return ["message"=>"completed"];
    }

}
