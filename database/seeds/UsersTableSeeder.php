<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\User::class, 500)->create()->each(function ($user) {
           for($i=0; $i<=rand(1,20); $i++){
               $user->tweets()->save(factory(App\Tweet::class)->make());
           }
       });
    }
}
