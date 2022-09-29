<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = new Car();
        $car->user_id = 2;
        $car->make = 'Honda';
        $car->model = 'Civic';
        $car->year = '2015';
        $car->number_plate = 'ET-176';
        $car->status = 'active';
        $car->save();



        $car = new Car();
        $car->user_id = 2;
        $car->make = 'Toyota';
        $car->model = 'GLI';
        $car->year = '2015';
        $car->number_plate = 'ET-13';
        $car->status = 'active';
        $car->save();




        $car = new Car();
        $car->user_id = 2;
        $car->make = 'Suzuki';
        $car->model = 'Mehran';
        $car->year = '2015';
        $car->number_plate = 'ET-521';
        $car->status = 'active';
        $car->save();




    }
}
