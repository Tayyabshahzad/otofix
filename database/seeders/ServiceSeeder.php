<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->title = 'Wrench';
        $service->icon_name = 'Wrench';
        $service->status = 'active';
        $service->save();


        $service = new Service();
        $service->title = 'Oil';
        $service->icon_name = 'Oil';
        $service->status = 'active';
        $service->save();



        $service = new Service();
        $service->title = 'Disk_Break';
        $service->icon_name = 'Disk_Break';
        $service->status = 'active';
        $service->save();


        $service = new Service();
        $service->title = 'Balance';
        $service->icon_name = 'Balance';
        $service->status = 'active';
        $service->save();

        $service = new Service();
        $service->title = 'Engine';
        $service->icon_name = 'Engine';
        $service->status = 'active';
        $service->save();


        $service = new Service();
        $service->title = 'Wheels';
        $service->icon_name = 'Wheels';
        $service->status = 'active';
        $service->save();


        $service = new Service();
        $service->title = 'Car_Wash';
        $service->icon_name = 'Car_Wash';
        $service->status = 'active';
        $service->save();

        $service = new Service();
        $service->title = 'Tow_Truck';
        $service->icon_name = 'Tow_Truck';
        $service->status = 'active';
        $service->save();
    }
}
