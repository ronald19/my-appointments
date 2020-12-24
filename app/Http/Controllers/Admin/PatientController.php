<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function performValidation(Request $request)
    {
        $rules = [
            'dni' => 'required|digits:8',
            'name' => 'required',
            'email' => 'required|email',
        ];

        $messages = [
            'dni.required' => 'Debe ingresar la cedula',
            'dni.digits:8' => 'La cedula no puede exceder 8 caracteres'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function index()
    {
        //
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->performValidation($request);
        /*User::create([
            $request->only('name', 'email', 'dni', 'address', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        ]);

        $notification = 'Registro almacenado satisfactoriamente!';
        return redirect('/doctors')->with(compact('notification'));*/
        //dd($request);
        $patient = new User();
        $patient->name = $request->input('name');
        $patient->address = $request->input('address');
        $patient->dni = $request->input('dni');
        $patient->phone = $request->input('phone');
        $patient->email = $request->input('email');
        $patient->password = bcrypt($request->input('password'));
        $patient->role = 'patient';
        $patient->save();//INSERT

        $notification = 'Registro almacenado satisfactoriamente!';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->performValidation($request);
        $patient = User::patients()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
        $patient->fill($data);
        $patientName = $patient->name;
        $patient->save();

        $notification = 'El paciente '.$patientName.' fue actualizado satisfactoriamente!';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        //dd($doctor);
        $deletedName = $patient->name;
        /*$User->delete();
        $notification = 'La especialidad '.$deletedName.' fue eliminada';
        return redirect('/specialties')->with(compact('notification'));*/
        $patient->deleted_at = now();
        $patient->save();
        $notification = 'El paciente '.$deletedName.' fue eliminado';
        return redirect('/patients')->with(compact('notification'));
    }
}
