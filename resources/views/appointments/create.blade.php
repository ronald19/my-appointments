@extends('layouts.panel')

@section('content')

  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar nueva cita</h3>
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

    <div class="card bg-secondary shadow border-0">
      <div class="card-body">
        @if($errors->any())
          <div class="alert alert-danger" role="alert">
            <ul>
              @foreach($errors->all() as $error)
                <li>
                  {{ $error }}
                </li>
              @endforeach
            </ul>
          </div>
        @endif
        <form action="{{ route('appointments.store') }}" method="POST">
          @csrf

          <div class="form-row">
            <div class="form-group mb-3 col-md-6">
              <label for="specialty">Especialidad: <span class="text-danger">*</span></label>
              <div class="input-group input-group-alternative">
                <select class="form-control  @error('specialty_id') is-invalid @enderror" name="specialty_id" id="specialty" required>
                  <option value="">Seleccione la especialidad</option>
                  @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>{{ $specialty->name }}</option>
                  @endforeach
                </select>
                @error('specialty_id')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>

            <div class="form-group mb-3 col-md-6">
              <label for="doctor_id">Médico: <span class="text-danger">*</span></label>
              <div class="input-group input-group-alternative">
                <select class = "form-control" name="doctor_id" id="doctor" required>
                  <opción value="">--</opción>
                  @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                  @endforeach
                </select>
                @error('doctor_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="description">Descripción: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Describa brevemente el motivo de la cita" required>{{ old('description') }}</textarea>
              @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="date">Fecha: <span class="text-danger">*</span></label>
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
              <input class="form-control @error('date') is-invalid @enderror datepicker" placeholder="01/01/1900" type="text" name="date" id="date" value="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+45d" autocomplete="date" required>
              @error('date')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="time">Hora de atención: <span class="text-danger">*</span></label>
            <div id="hours">
                <div class="alert alert-info" role="alert">
                    <strong>Selecciona el médico y las fecha para visualizar sus horas disponibles</strong>
                </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="type">Tipo de consulta: <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="custom-control custom-radio">
                  <input type="radio" id="type1" name="type" class="custom-control-input" checked>
                  <label class="custom-control-label" for="type1">Consulta</label>
              </div>
            </div>
            <div class="input-group">
              <div class="custom-control custom-radio">
                  <input type="radio" id="type2" name="type" class="custom-control-input">
                  <label class="custom-control-label" for="type2">Examen</label>
              </div>
            </div>
            <div class="input-group">
              <div class="custom-control custom-radio">
                  <input type="radio" id="type3" name="type" class="custom-control-input">
                  <label class="custom-control-label" for="type3">Operación</label>
              </div>
              @error('type')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <hr>
          <span class="text-danger btn-sm">* Campo(s) obligatorios</span>

          <div class="col text-right pt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('home') }}" class="btn btn-default">
              Cancelar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <br><br>
@endsection

@section('script')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection
