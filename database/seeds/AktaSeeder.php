<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Query\Builder;
use App\ModelFactory;
use App\aktalahir;

class AktaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\aktalahir::class, 50)->create()->each(function ($u) {
                $u->posts()->save(factory(App\aktalahir::class)->make());
         });*/
        //$time_start = microtime(true);  
       
        factory(App\aktalahir::class,20)->create();
         
         $this->command->info("data akta berhasil di tambahkan");
         
    }
}
