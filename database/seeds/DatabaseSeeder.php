<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         factory(App\User::class,2)->create()->each(function($user){
         	$user->profile()->save(factory(App\Profile::class)->make());
         });

      //   $this->call(ArticlesTableSeeder::class);


    }
}
