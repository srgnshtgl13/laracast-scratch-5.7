<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Project;
use Illuminate\Http\Request;
use PDF;

class FlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $fligths = Flight::get()->chunk(5000);
        return view('flight.index');
    }

    public function getFlightsData($pg=""){
        /*$fligths = Flight::offset(0)->limit(100)->get();*/
        $fligths = Flight::paginate(10);
        if($pg!=""){
            $fligths = Flight::paginate($pg);
        }
        
        return $fligths;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("flight.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $flight = new Flight();
            $attributes = $request->validate([
                'name' => 'required|min:4|max:200',
            ]);
            $attributes['slug'] = $flight->createUniqueSlug($request->name);

            Flight::create($attributes);
            return ["message"=>$attributes['slug']];

        }catch(\Exception $e){
            return ['message'=> $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        //
        return $flight;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        //
    }

    public function pdfTest(){
        $shows = Flight::limit(100)->get();
        return view('pdf.index', compact(['shows']));
    }

    public function downloadPDF() {
        $data['title'] = 'Flights';
        $data['flights'] =  Flight::limit(100)->get();;
        $pdf = PDF::loadView('pdf.file', $data);
        
        return $pdf->download('flights.pdf');
    }
}
