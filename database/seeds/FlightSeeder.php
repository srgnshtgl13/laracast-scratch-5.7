<?php

use Illuminate\Database\Seeder;
use App\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<=100000; $i++){

	        $flight = new Flight();
	        $attributes = [
	            'name' => 'flight-'.$i,
	            'slug' => 'flight_'.$i,
	        ];
	        Flight::create($attributes);
        }
    }
}
