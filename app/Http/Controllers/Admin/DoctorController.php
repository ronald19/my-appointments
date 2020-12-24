<?php

namespace App\Http\Controllers\Admin;

//use App\Doctor;
use App\Http\Controllers\Controller;
use App\Specialty;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    //se añade al constructor el middleware para validar
    //usuarios autenticados
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specialties = Specialty::specialties()->get();
        return view('doctors.create', compact('specialties'));
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*$rules = [
            'dni' => 'required|digits:8',
            'name' => 'required',
            'email' => 'required|email',
        ];

        $messages = [
            'dni.required' => 'Debe ingresar la cedula',
            'dni.digits:8' => 'La cedula no puede exceder 8 caracteres'
        ];

        $this->validate($request, $rules, $messages);

        $user = User::create([
            $request->only('dni', 'name', 'email', 'address', 'phone')
            + [
                'password' => bcrypt($request->input('password')),
                'role' => 'doctor'
            ]
        ]);

        $user->specialties()->attach($request->input('specialties'));

        $notification = 'Registro almacenado satisfactoriamente!';
        return redirect('/doctors')->with(compact('notification'));*/

        $this->performValidation($request);
        $doctor = new User();
        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->dni = $request->input('dni');
        $doctor->phone = $request->input('phone');
        $doctor->email = $request->input('email');
        $doctor->password = bcrypt($request->input('password'));
        $doctor->role = 'doctor';
        $doctor->save();//INSERT
        $doctor->specialties()->attach($request->input('specialties'));

        $notification = 'Registro almacenado satisfactoriamente!';
        return redirect('/doctors')->with(compact('notification'));

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
        $specialties = Specialty::specialties()->get();
        $doctor = User::doctors()->findOrFail($id);
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');//obtiene los id relacionados al doctor
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
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
        $doctor = User::doctors()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
        $doctor->fill($data);
        $doctorName = $doctor->name;
        $doctor->save();//UPDATE

        //sync permite gestionar las relaciones N - N
        //borra los datos del usuario encontrado y hace
        //un nuevo insert con los nuevos valores
        $doctor->specialties()->sync($request->input('specialties'));

        $notification = 'El médico '.$doctorName.' fue actualizado satisfactoriamente!';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        //dd($doctor);
        $deletedName = $doctor->name;
        /*$User->delete();
        $notification = 'La especialidad '.$deletedName.' fue eliminada';
        return redirect('/specialties')->with(compact('notification'));*/
        $doctor->deleted_at = now();
        $doctor->save();
        $notification = 'El médico '.$deletedName.' fue eliminado';
        return redirect('/doctors')->with(compact('notification'));
    }
}
