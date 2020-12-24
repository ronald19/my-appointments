<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    User::create([
        'dni' => '11924787',
        'name' => 'Ronald Maza',
        'email' => 'tremd19@gmail.com',
        'email_verified_at' => now(),
        'address' => '',
        'phone' => '+584126041574',
        'password' => bcrypt('iumcoelfa'), // iumcoelfa
        'role' => 'admin',
        'remember_token' => Str::random(10),
    ]);

    User::create([
        'dni' => '12455427',
        'name' => 'Marlene Montilla',
        'email' => 'marlenemontilla19@gmail.com',
        'email_verified_at' => now(),
        'address' => '',
        'phone' => '+584126041574',
        'password' => bcrypt('iumcoelfa'), // iumcoelfa
        'role' => 'doctor',
        'remember_token' => Str::random(10),
    ]);

    User::create([
        'dni' => '21130002',
        'name' => 'Migdelis Bernal',
        'email' => 'migdelis@gmail.com',
        'email_verified_at' => now(),
        'address' => '',
        'phone' => '+584126041574',
        'password' => bcrypt('iumcoelfa'), // iumcoelfa
        'role' => 'patient',
        'remember_token' => Str::random(10),
    ]);

    	factory(User::class, 50)->state('patient')->create();
    }
}
