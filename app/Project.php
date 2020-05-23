<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\ProjectCreated;
use App\Events\ProjectCreated as ProjectCreatedEvent;


class Project extends Model
{
	
	/*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
    	'title', 'description'
    ];*/

    // or instead of using the $fillable property we can use $guarded property like below
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ProjectCreatedEvent::class,
    ];

    /*public static function boot(){
        parent::boot();
        static::created(function($project){
            \Mail::to($project->owner->email)->send(
                new ProjectCreatedEvent($project)
            );
        });
    }*/

    public function owner(){
        return $this->belongsTo(User::class);
    }
    
    //a project can have many tasks
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function addTask($task){

        /*return Task::create([
            'project_id'=>$this->id,
            'description'=>$description
        ]);*/
        // also instead of the method like above we can use the relationship in here like below
        $this->tasks()->create($task);

    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }


    // instead of doing this, make:observer(ProjectObserer) and create the slug inside the creating event
    /*public static function boot(){
        parent::boot();

        static::creating(function($project){
            $project->slug=\Str::slug($project->title);

        });
    }*/
}
