@extends('layouts.panel')

@section('content')

  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
    		<div class="col">
    			<h3 class="mb-0">Nueva especialidad</h3>
    		</div>
    	</div>
    </div>

    <div class="card bg-secondary shadow border-0">
      <div class="card-body">
        <form action="{{ route('specialties.store') }}" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="name">Nombre de la especialidad: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese la especialidad" type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name" autofocus required>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="description">Descripción:</label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('description') is-invalid @enderror" placeholder="Ingrese su descripción (Opcional)" type="text" name="description" id="description" value="{{ old('description') }}" autocomplete="description">
              @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <span class="text-danger btn-sm">* Campo(s) obligatorios</span>

          <div class="col text-right pt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('specialties.index') }}" class="btn btn-default">
              Cancelar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
