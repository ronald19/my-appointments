<?php

use App\Specialty;
use App\User;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $specialties = [
        	'Medicina general', 'Pediatría', 'Oftalmología', 'Traumatología'
        ];

        foreach ($specialties as $specialtyName) {
        	# code...
        	$specialty = Specialty::create([
		        'name' => $specialtyName
		    ]);
            $specialty->users()->saveMany(
                factory(User::class, 3)->state('doctor')->make()
            );
        }

        //se asocia un usuario especifico (2) a una especialidad
        User::find(2)->specialties()->save($specialty);

    }
}
