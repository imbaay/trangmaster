<?php

use Faker\Factory;
use App\Noisanxuat;
use Illuminate\Database\Seeder;

class NoisanxuatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $noisanxuat = [];

        for($i = 1; $i <= 8; $i++)
        {
            $noisanxuat [] = [
                'name' => $faker->name,
                'slug'=> $faker->slug(2),
                'bio' => $faker->paragraphs(rand(2,4), true)
            ];
        }

        Noisanxuat::truncate();
        Noisanxuat::insert($noisanxuat);
    }
}
