<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->phone = '0000';
        $user->email_verified_at = '2022-08-17 23:40:37';
        $user->password = bcrypt("pakistan");
        $user->address = 'Dummy';
        $user->registered_type = 'email';
        $user->status = 'active';
        $user->save();
        $user->assignRole('admin');


        $user_customer = new User;
        $user_customer->name = 'Customer';
        $user_customer->email = 'customer@gmail.com';
        $user_customer->phone = '1111';
        $user_customer->email_verified_at = '2022-08-17 23:40:37';
        $user_customer->password = bcrypt("pakistan");
        $user_customer->address = 'Dummy';
        $user_customer->registered_type = 'email';
        $user_customer->status = 'active';
        $user_customer->save();
        $user_customer->assignRole('admin');

        $user2 = new User;
        $user2->name = 'Workshop';
        $user2->email = 'workshop@gmail.com';
        $user2->phone = '10000';
        $user2->email_verified_at = '2022-08-17 23:40:37';
        $user2->password = bcrypt("pakistan");
        $user2->address = 'Dummy';
        $user2->registered_type = 'email';
        $user2->status = 'active';
        $user2->save();
        $user2->assignRole('workshop');

        $workshop = new Workshop;
        $workshop->user_id = $user2->id;
        $workshop->name = 'ZA Autos';
        $workshop->address = 'Dummy';
        $workshop->lat =24.8607343;
        $workshop->lng = 73.0777435;
        $workshop->status = 'active';
        $workshop->save();





        $user2 = new User;
        $user2->name = 'Mian Group ';
        $user2->email = 'mian@group.com';
        $user2->phone = '1034';
        $user2->email_verified_at = '2022-08-17 23:40:37';
        $user2->password = bcrypt("pakistan");
        $user2->address = 'Dummy';
        $user2->registered_type = 'email';
        $user2->status = 'active';
        $user2->save();
        $user2->assignRole('workshop');

        $workshop = new Workshop;
        $workshop->user_id = $user2->id;
        $workshop->name = 'Mian Group';
        $workshop->address = 'Dummy';
        $workshop->lat =24.8607343;
        $workshop->lng = 73.0777435;
        $workshop->status = 'active';
        $workshop->save();



    }
}
