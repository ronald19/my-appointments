@extends('layouts.panel')

@section('styles')
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-select.min.css') }}">
@endsection

@section('content')

  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
    		<div class="col">
    			<h3 class="mb-0">Nuevo médico</h3>
    		</div>
    	</div>
    </div>

    <div class="card bg-secondary shadow border-0">
      <div class="card-body">
        <form action="{{ route('doctors.store') }}" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="dni">Cédula del médico: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('dni') is-invalid @enderror" placeholder="Ingrese la cédula" type="text" name="dni" id="dni" value="{{ old('dni') }}" autocomplete="dni" autofocus required>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="name">Nombre del médico: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre del médico" type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name" autofocus required>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="phone">Teléfono(s):</label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('phone') is-invalid @enderror" placeholder="Ingrese el teléfono" type="text" name="phone" id="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
              @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="specialties">Especialidad(es): <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <select class="form-control selectpicker @error('specialties') is-invalid @enderror" multiple name="specialties[]" id="specialties" value="{{ old('specialties') }}" data-style="btn-outline-secondary" title="Seleccione una o varias especialidades" required>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
              </select>
              @error('specialties')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="email">Correo Electrónico: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('email') is-invalid @enderror" placeholder="correo@correo.com" type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="password">Contraseña: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese el teléfono" type="text" name="password" id="password" value="{{ Str::random(6) }}" autocomplete="password" autofocus>
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="address">Dirección:</label>
            <div class="input-group input-group-alternative">
              <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Ingrese su dirección (Opcional)" type="text" name="address" id="address" value="{{ old('address') }}" autocomplete="address"></textarea>
              @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <span class="text-danger btn-sm">* Campo(s) obligatorios</span>

          <div class="col text-right pt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-default">
              Cancelar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <!-- Latest compiled and minified JavaScript -->
  <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
@endsection
