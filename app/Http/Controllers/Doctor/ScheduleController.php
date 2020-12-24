<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    private $days = [
		'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
	];

    public function edit()
    {
    	//verifica si el user de sesion posee registro, sino agrega un horario por default
		for($i=0; $i<7; $i++){
			$workDays = WorkDay::firstOrCreate(
			    [
			    	'day' => $i,
			    	'user_id' => auth()->id()	//id del user en sesion
			    ],
			    [
			    	'active' => '0',//buscar el dia en el array active
			        'morning_start' => '05:00:00',
			        'morning_end' => '05:00:00',
			        'afternoon_start' => '13:00:00',
			        'afternoon_end' => '13:00:00'
			    ]
			);
		}

		$workDays = WorkDay::where('user_id', auth()->id())->get();

		$workDays->map(function($workDay){
			//Carbon convierte las horas a formato 1:00 AM/PM
			$workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
			$workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
			$workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
			$workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
		});

		$days = $this->days;
    	return view('schedule', compact('workDays', 'days'));
    }

    public function store(Request $request)
    {
    	//dd($request->all());
    	$active = $request->input('active') ?: [];//se verifica si active tiene valor
    	$morning_start = $request->input('morning_start');
    	$morning_end = $request->input('morning_end');
    	$afternoon_start = $request->input('afternoon_start');
    	$afternoon_end = $request->input('afternoon_end');

    	$errors = [];
    	for($i=0; $i<7; $i++){
    		if($morning_start[$i] > $morning_end[$i]){
    			$errors[] = "Las horas seleccionadas del turno mañana son inconsistentes para el día $this->days[$i]";
    		}
    		if($afternoon_start[$i] > $afternoon_end[$i]){
    			$errors[] = "Las horas seleccionadas del turno tarde son inconsistentes para el día $this->days[$i]";
    		}
	    	WorkDay::updateOrCreate(
			    [
			    	'day' => $i,
			    	'user_id' => auth()->id()	//id del user en sesion
			    ],
			    [
			    	'active' => in_array($i, $active),//buscar el dia en el array active
			        'morning_start' => $morning_start[$i],
			        'morning_end' => $morning_end[$i],
			        'afternoon_start' => $afternoon_start[$i],
			        'afternoon_end' => $afternoon_end[$i]
			    ]
			);
	    }

	    if(count($errors) > 0)
	    	return back()->with(compact('errors'));

	    $notification = 'Registro almacenado satisfactoriamente';
	    return back()->with(compact('notification'));
    }
}
