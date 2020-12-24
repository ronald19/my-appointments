@extends('layouts.panel')

@section('content')

<div class="card shadow">
  <div class="card-header border-0">
  	<div class="row align-items-center">
  		<div class="col">
  			<h3 class="mb-0">Especialidades</h3>
  		</div>
  		<div class="col text-right">
  			<a href="{{ route('specialties.create') }}" class="btn btn-sm btn-primary">
  				Nueva especialidad
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
    <!-- Specialities table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($specialties as $specialty)
          <tr>
            <th scope="row">
              {{ $specialty->name }}
            </th>
            <td>
              {{ $specialty->description }}
            </td>
            <td>
              <a href="{{ route('specialties.edit', $specialty->id) }}"><i class="btn fa fa-edit text-info btn-sm" aria-hidden="true"></i></a>
              <a href="#delete{{$specialty->id}}" data-toggle="modal"><i class="btn fa fa-trash text-danger btn-sm"></i></a>
              <!-- Modal -->
              @include('specialties.modal')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
