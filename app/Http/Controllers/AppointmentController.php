<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Specialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function create()
    {
    	$specialties = Specialty::specialties()->get();

    	$specialtyId = old('specialty_id');

    	if($specialtyId){
    		$specialty = Specialty::find($specialtyId);
    		$doctors = $specialty->users;
    		//dd($doctors);
    	}else{
    		$doctors = collect();
    	}

    	return view('appointments.create', compact('specialties', 'doctors'));
    }

    public function store(Request $request)
    {
    	$rules = [
    		'description' => 'required',
			'specialty_id' => 'exists:specialties,id',
			'doctor_id' => 'exists:users,id',
    		'scheduled_time' => 'required'
    	];

    	$messages = [
    		'scheduled_time.required' => 'Seleccione una hora valida para su cita'
    	];

    	$this->validate($request, $rules, $messages);

    	$data = $request->only([
    		'description',
			'specialty_id',
			'doctor_id',
    		'scheduled_date',
    		'scheduled_time',
    		'type'
    	]);

    	//id del paciente autenticado
    	$data['patient_id'] = auth()->id();
    	Appointment::create($data);

    	$notification = "La cita fue registrada satisfactoriamente";
    	return back()->with(compact('notification'));
    }
}
