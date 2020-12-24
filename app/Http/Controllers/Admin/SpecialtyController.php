<?php

namespace App\Http\Controllers\Admin;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
	//se añade al constructor el middleware para validar
	//usuarios autenticados
	public function __construct()
	{
		$this->middleware('auth');
	}

    //vista listado de especialidades
	public function index()
	{
		$specialties = Specialty::specialties()->get();
		/*return view('specialties.index', compact('specialties'));*/
		//$specialties = DB::table('specialties')->whereNull('deleted_at')->get();
		return view('specialties.index', compact('specialties'));
	}

	//vista formulario de especialidades
	public function create()
	{
		return view('specialties.create');
	}

	private function performValidation(Request $request)
	{
		$rules = [
			'name' => 'required'
		];

		$messages = [
			'name.required' => 'Debe ingresar la especialidad'
		];

		$this->validate($request, $rules, $messages);
	}

	//guardar registro de especialidades
	public function store(Request $request)
	{
		//dd($request->all());
		$this->performValidation($request);
		$specialty = new Specialty();
		$specialty->name = $request->input('name');
		$specialty->description = $request->input('description');
		$specialty->save();//INSERT

		$notification = 'Registro almacenado satisfactoriamente!';
		return redirect('/specialties')->with(compact('notification'));
	}

	//vista formulario de edición de la especialidad
	public function edit(Specialty $specialty)
	{
		return view('specialties.edit', compact('specialty'));
	}

	//actualización formulario de edición de la especialidad
	public function update(Request $request, Specialty $specialty)
	{
		//dd($request->all());
		$this->performValidation($request);
		$specialty->name = $request->input('name');
		$specialty->description = $request->input('description');
		$specialty->save();//UPDATE

		$notification = 'Registro actualizado satisfactoriamente!';
		return redirect('/specialties')->with(compact('notification'));
	}

	//eliminar la especialidad
	public function destroy(Specialty $specialty)
	{
		$deletedName = $specialty->name;
		/*$specialty->delete();
		$notification = 'La especialidad '.$deletedName.' fue eliminada';
		return redirect('/specialties')->with(compact('notification'));*/
		$specialty->deleted_at = now();
		$specialty->save();
		$notification = 'La especialidad '.$deletedName.' fue eliminada';
		return redirect('/specialties')->with(compact('notification'));
	}
}
