<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0;$i<=20;$i++){
            DB::table('posts')->insert([
                'title'=>$faker->text(10),
                'created_at'=>now(),
                'updated_at'=>now(),
                'text'=>$faker->text,
                'user_id'=>rand(1,5)
            ]);
        }
    }
}
