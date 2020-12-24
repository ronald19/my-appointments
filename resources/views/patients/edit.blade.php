@extends('layouts.panel')

@section('content')

  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
    		<div class="col">
    			<h3 class="mb-0">Nuevo paciente</h3>
    		</div>
    	</div>
    </div>

    <div class="card bg-secondary shadow border-0">
      <div class="card-body">
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group mb-3">
            <label for="dni">Cédula del paciente: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('dni') is-invalid @enderror" placeholder="Ingrese la cédula" type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" autocomplete="dni" autofocus required>
              @error('dni')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="name">Nombre del paciente: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre del paciente" type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" autocomplete="name" required>
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
              <input class="form-control @error('phone') is-invalid @enderror" placeholder="Ingrese el teléfono" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" autocomplete="phone">
              @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="email">Correo Electrónico: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('email') is-invalid @enderror" placeholder="correo@correo.com" type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" autocomplete="email" required>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="password">Contraseña: </label>
            <div class="input-group input-group-alternative">
              <input class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese la contraseña" type="text" name="password" id="password" autocomplete="password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <p class="text-danger btn-sm">Ingrese un valor sólo si desea cambiar la contraseña</p>
          </div>

          <div class="form-group mb-3">
            <label for="address">Dirección:</label>
            <div class="input-group input-group-alternative">
              <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Ingrese su dirección (Opcional)" type="text" name="address" id="address" value="" autocomplete="address">{{ old('address', $patient->address) }}</textarea>
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
            <a href="{{ route('patients.index') }}" class="btn btn-default">
              Cancelar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
