<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0;$i<=4;$i++){
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email'=>$faker->email,
                'password'=>$faker->password,
                'role_id'=>rand(1,2),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
