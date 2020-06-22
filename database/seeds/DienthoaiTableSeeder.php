<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DienthoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dienthoais')->truncate();

        $faker = Faker\Factory::create();

        $books = [];


        for ($i = 1; $i <= 50; $i++)
        {

            $init_price = rand(250, 400);
            $discount_rate = rand(0,5);
            $count_discount = (($init_price * $discount_rate)/100);
            $final_price = $init_price - $count_discount;

            $dienthoai [] = [
                'title'         => $faker->sentence(rand(8,12)),
                'slug'          => $faker->slug(rand(2,4)),
                'description'   => $faker->paragraphs(rand(8,12), true),
                'noisanxuat_id'     => rand(1,8),
                'danhmuc_id'   => rand(1,6),
                'image_id'      => rand(1,30),
                'quantity'      => rand(10, 40),
                'init_price'    => $init_price,
                'discount_rate' => $discount_rate,
                'price'         => $final_price,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')

            ];
        }

        DB::table('dienthoais')->insert($dienthoai);
    }
}
