<?php

use Illuminate\Database\Seeder;

class detail_kartukeluarga_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\detail_kartukeluarga::class,10)->create();
        $this->command->info("berhasil");
    }
}
