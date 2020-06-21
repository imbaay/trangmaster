<?php

use Illuminate\Database\Seeder;

class DanhmucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmuc')->truncate();

        DB::table('danhmuc')->insert([
            [
                'name' => 'iPhone',
                'slug' => 'iphone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'  => 'Samsung',
                'slug'  => 'samsung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'  => 'Huawei',
                'slug'  => 'huawei',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'  => 'Xiaomi',
                'slug'  => 'xiaomi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'  => 'Bphone',
                'slug'  => 'bphone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'   => 'Oppo',
                'slug'   => 'oppo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'  => 'Nokia',
                'slug'  => 'nokia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
