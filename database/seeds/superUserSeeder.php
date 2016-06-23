<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class superUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'     =>  'hassaan105@gmail.com',
            'password'  =>  bcrypt('binarystar'),
            'role'      =>  'super_super'
        ]);
    }
}
