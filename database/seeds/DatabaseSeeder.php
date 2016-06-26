<?php

use App\Models\User;
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
         //$this->call(superUserSeeder::class);
        User::create([
            'email'     =>  'ssu@gmail.com',
            'password'  =>  bcrypt('binarystar'),
            'role'      =>  'super_super'
        ]);
    }
}
