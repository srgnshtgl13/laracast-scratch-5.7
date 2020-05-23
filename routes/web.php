<?php


use App\Repositories\UserRepository;
use App\Services\Twitter;
use Illuminate\Http\Request;
Route::get('/example', function(UserRepository $users, Twitter $twitter){
	//dd($users->create(["User1","User2","User3"]));	
	dd($twitter);
});

Route::get('addip', function() {
	return view('ips.form');
})->name('addip');

Route::post('addip', function(Request $request) {
	$attr = $request->validate([
        'ipv4' => 'ip|ipv4',
    ]);
	return response()->json($attr);
})->name('addip.submit');

Route::get('addfile', function() {
	return view('files.addfile');
});
Route::post('addfile', function(Request $request) {
	// $path = $request->file('file')->store('avatars');
	$image_name = uniqid().'.'.$request->file->getClientOriginalExtension();
    $request->file->move(public_path('images'), $image_name);
	return public_path('images/'.$image_name);
})->name('addfilepost');


Route::get('/', 'PagesController@home');
Route::get('/welcome', 'PagesController@welcome');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

//Project Routes
Route::resource('projects', 'ProjectController');
Route::get('/projectsall', 'ProjectController@indexAll');

// Task Routes
Route::get('/tasks/{project}', 'ProjectTaskController@get');
Route::post('/tasks/{project}', 'ProjectTaskController@store');

// Create another controller to handle the "Task Completing Routes"
Route::post('/completed-task/{task}', 'CompletedTasksController@store');
Route::delete('/completed-task/{task}', 'CompletedTasksController@destroy');

// Test the unique slug
Route::resource('flights', 'FlightsController');
Route::get('/getFlightsData/{pg?}', 'FlightsController@getFlightsData')->name('getFlightsData');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', function(){
	//dd('profile');
	return view('auth.profile');
})->name('profile')->middleware('auth');

use App\Notifications\SubscriptionRenewalFailed;
Route::get('/notification-renewal-failed', function(){
	$user = App\User::first();
	$user->notify(new SubscriptionRenewalFailed);
	return 'Done';
});

Route::get('pdfTest', 'FlightsController@pdfTest');
Route::get('downloadPdf', 'FlightsController@downloadPDF')->name('downloadPdf');