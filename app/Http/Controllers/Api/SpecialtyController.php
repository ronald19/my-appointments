<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    //
    public function doctors(Specialty $specialty)
    {
    	//para obtener los medicos asociados a una especialidad
    	return $specialty->users()->get(['users.id', 'users.name']);
    }
}
