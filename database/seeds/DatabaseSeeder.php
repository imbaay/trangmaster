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
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DanhmucTableSeeder::class);
        $this->call(DienthoaiTableSeeder::class);
        $this->call(NoisanxuatTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(DanhgiaTableSeeder::class);
    }
}
