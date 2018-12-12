<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(UsersTableSeeder::class);

       factory(App\Feature::class, 10)->create();
       factory(\App\Person::class, 15)->create();
  //  factory(\App\Reservation::class, 12)->create();
    }
}
