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
        
        $this->call(kecamatanSeeder::class);        
        $this->call(desaSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AktaSeeder::class);
        //$this->call(kkSeeder::class);
        //$this->call(detail_kartukeluarga_Seeder::class);
    }
}
