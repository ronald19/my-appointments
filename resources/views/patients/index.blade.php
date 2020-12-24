@extends('layouts.panel')

@section('content')

<div class="card shadow">
  <div class="card-header border-0">
  	<div class="row align-items-center">
  		<div class="col">
  			<h3 class="mb-0">Pacientes</h3>
  		</div>
  		<div class="col text-right">
  			<a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">
  				Nuevo paciente
  			</a>
  		</div>
  	</div>
  </div>
  <div class="card-body">
    @if(session('notification'))
      <div class="alert alert-success" role="alert">
        <strong>{{ session('notification') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>

  <div class="table-responsive">
    <!-- Doctors table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Cedula</th>
          <th scope="col">Nombre</th>
          <th scope="col">E-mail</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($patients as $patient)
          <tr>
            <td scope="row">
              {{ $patient->dni }}
            </td>
            <td>
              {{ $patient->name }}
            </td>
            <td>
              {{ $patient->email }}
            </td>
            <td>
              <a href="{{ route('patients.edit', $patient->id) }}"><i class="btn fa fa-edit text-info btn-sm" aria-hidden="true"></i></a>
              <a href="#delete{{$patient->id}}" data-toggle="modal"><i class="btn fa fa-trash text-danger btn-sm"></i></a>
              <!-- Modal -->
              @include('patients.modal')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    {{ $patients->links() }}
  </div>
</div>
<br><br>
@endsection
