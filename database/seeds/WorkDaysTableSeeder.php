<?php

use App\WorkDay;
use Illuminate\Database\Seeder;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crear un horario para un Doctor XXXXX
        for($i=0; $i<7; $i++){
			$workDays = WorkDay::create([
			    	'day' => $i,
			    	'user_id' => 2,	//id del user en UserTableSeeder
			    	'active' => ($i == 3 ? '1' : '0'),//el dia Jueves
			        'morning_start' => ($i == 3 ? '07:00:00' : '05:00:00'),
			        'morning_end' => ($i == 3 ? '09:30:00' : '05:00:00'),
			        'afternoon_start' => ($i == 3 ? '15:00:00' : '13:00:00'),
			        'afternoon_end' => ($i == 3 ? '18:00:00' : '13:00:00')
			    ]
			);
		}
    }
}
