<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Session;

use App\Services\Twitter; // Custom Service 

use App\Mail\ProjectCreated;
use App\Events\ProjectCreated as ProjectCreatedEvent;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','indexAll','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()) { $projects = auth()->user()->projects; } 
        else { $projects = null; }
        // $projects = Project::where(['owner_id'=>auth()->id()])->get();
        // return $projects; // this will return json data


        $message = session()->get('message');

        if(\Auth::guest()){ //if not logged in flash a message
            $message = session()->flash('message', 'You have to be login!');
            Session::flash('alert-class', 'alert-warning'); 
        }

        return view("projects.index", compact('projects'), ["message"=>$message]); // or we can say view("projects.index",["projects"=>$projects]);
    }

    public function indexAll()
    {
        if(\Auth::check()) { $projects = auth()->user()->projects; } 
        else { $projects = null; }
        // $projects = Project::where(['owner_id'=>auth()->id()])->get();
        return $projects; // this will return json data
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => 'required|unique:projects|min:4|max:255',
            'description' => 'required',
        ]);
        // </validation>
        $attributes['owner_id'] = auth()->id(); // or we can add like that Project::create($attributes+['owner_id'=>auth()->id()]);
        
        // Way-1
            /*$project = new Project();
            $project->title=request('title');
            $project->description=request('description');
            $project->save();*/
        // Way-2
            // Project::create($request->all());    // Never do this! Or if you will do this make sure in the model you set the fillable fields correctly
            // request(['title','description']) and $attributes return the same things
        $project=Project::create($attributes);
        // </create-project>

        //event(new ProjectCreatedEvent($project)); // after we fire $dispatchesEvents in model we no longer have to use this in here

        
        // < send-email-after-project-created-location-of-email-is-storage/logs/(today-date-whatever-is).log>
        return ['message'=>$project->title];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // 1
        // if the user is not authorized to review the wanted projects
        /*if($project->owner_id !== auth()->id()){
            abort(403);
        } */

        // 2
        // also instead of doing like above we can do shortcut like below
        // abort_if($project->owner_id !== auth()->id(),403);
        
        // 3
        // or instead of doing like above we can create a policy and we can use like below:
        $this->authorize('view',$project);

        // 4
        // also with \Gate Facades
        //abort_if(\Gate::denies('view',$project),403);

        return view("projects.show",compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // if(!$project){
        //     abort("Not found!",404);
        // }
        //$project = $project->findOrFail($project->id);
        return view("projects.edit", compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $attributes=$request->validate([
            //'title' => 'required|max:255|min:4|unique:projects,title,'.$project->id,
            'title' => ['required','max:25','min:4','unique:projects,title,'.$project->id],
            'description' => 'required',
        ]);

        /*$project->title = $request->title;
        $project->description = $request->description;
        $project->save();*/
        // instead of like above we can do update simply like below

        $project->update($attributes);

        Session::flash('message', $project->title.' was updated in successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/projects/'.$project->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        Session::flash('message', $project->title.' was deleted in successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/projects');
    }
}
