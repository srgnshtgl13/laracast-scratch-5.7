<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

	
    public function home(){

		$somethings = ["foo","larry","curly"];
	    return view('home',
					    	[
					    		'somethings'=>$somethings,
					    		'bar'=>'bar'
					    	]
		);
    }

    public function about(){
    	return view('about');
    }

    public function contact(){
    	return view('contact');
    }

    public function welcome(){
    	return view('welcome');
    }


}
