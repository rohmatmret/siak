<?php

use Illuminate\Database\Seeder;

class kkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\kartukeluarga::class, 5)->create()->each(function ($u) {
            $u->push()->save(factory(App\detail_kartukeluarga::class)->make());
        });
         
        //factory(App\kartukeluarga::class,10)->create();
        
        $this->command->info("data akta berhasil di tambahkan");
    }
}
