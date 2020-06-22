<?php

use App\Danhgia;
use Carbon\Carbon;
use Faker\Factory;
use App\Dienthoai;
use Illuminate\Database\Seeder;

class DanhgiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $danhgia = [];

        $dienthoais = Dienthoai::orderBy('id','DESC')->take(15)->get();
        foreach ($dienthoais as $dienthoai)
        {
            for ($i = 1; $i <= rand(1, 8); $i++)
            {
                $danhgiaDate = Carbon::now();
                $danhgia[] = [
                    'user_id'      => rand(1,3),
                    'dienthoai_id'      => $dienthoai->id,
                    'body'         => $faker->paragraphs(rand(1, 4), true),
                    'created_at'   => $danhgiaDate,
                    'updated_at'   =>  $danhgiaDate,
                ];
            }

        }
        Danhgia::truncate();
        Danhgia::insert($danhgia);
    }
}
