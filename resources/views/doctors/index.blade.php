@extends('layouts.panel')

@section('content')

<div class="card shadow">
  <div class="card-header border-0">
  	<div class="row align-items-center">
  		<div class="col">
  			<h3 class="mb-0">Médicos</h3>
  		</div>
  		<div class="col text-right">
  			<a href="{{ route('doctors.create') }}" class="btn btn-sm btn-primary">
  				Nuevo médico
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
        @foreach($doctors as $doctor)
          {{--@for($q;$q=$doctor;$q++)--}}
          <tr>
            <td scope="row">
              {{ $doctor->dni }}
            </td>
            <td>
              {{ $doctor->name }}
            </td>
            <td>
              {{ $doctor->email }}
            </td>
            <td>
              <a href="{{ route('doctors.edit', $doctor->id) }}"><i class="btn fa fa-edit text-info btn-sm" aria-hidden="true"></i></a>
              <a href="#delete{{$doctor->id}}" data-toggle="modal"><i class="btn fa fa-trash text-danger btn-sm"></i></a>
              <!-- Modal -->
              @include('doctors.modal')
            </td>
          </tr>
          {{--@endfor--}}
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    {{ $doctors->links() }}
  </div>
</div>
<br><br>
@endsection
