<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=admin::create([
        	'nama'=>'rohmat',
        	'email'=>'rohmat@gmail.com',
        	'nik'=>'320115',
        	'password'=>bcrypt('rahasia'),
        	'kecamatan_id'=>5,
            'desa_id'=>43,
            'active'=>1,           
        	]);

        $admin->save();
       

        $admin=admin::create([
            'nama'=>'admin',
            'email'=>'admin@gmail.com',
            'nik'=>'320124',
            'password'=>bcrypt('rahasia'),
            'kecamatan_id'=>5,
            'desa_id'=>43,
            'active'=>1,            
            ]);

        $admin->save();
        return $admin;
    }
}
