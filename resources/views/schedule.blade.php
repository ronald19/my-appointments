@extends('layouts.panel')

@section('content')

<form action="{{ route('schedule.store') }}" method="POST">
  @csrf
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Gestionar horario</h3>
        </div>
        <div class="col text-right">
          <button type="submit" class="btn btn-sm btn-primary">
            Guardar cambios
          </button type="submit">
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

      @if(session('errors'))
        <div class="alert alert-danger" role="alert">
          Los cambios se han guardado,pero debe tener en cuenta que:
          <ul>
            @foreach(session('errors') as $error)
              <li>
                {{ $error }}
              </li>
            @endforeach
          </ul>
          <strong>{{ session('errors') }}</strong>
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
            <th scope="col">Día</th>
            <th scope="col">Activo</th>
            <th scope="col">Turno mañana</th>
            <th scope="col">Turno tarde</th>
          </tr>
        </thead>
        <tbody>
          @foreach($workDays as $key => $workDay)
            <tr>
              <th>{{ $days[$key] }}</th>
              <th>
                <label class="custom-toggle">
                  <input type="checkbox" name="active[]" value="{{ $key }}" @if($workDay->active) checked @endif>
                  <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="SI"></span>
                </label>
              </th>
              <th>
                <div class="row">
                  <div class="col">
                    <select class="form-control" name="morning_start[]">
                      @for($i=5; $i<=11; $i++)
                        <option value="{{ ($i<10 ? '0' : '').$i }}:00"
                          @if($i.':00 AM' == $workDay->morning_start) selected @endif>
                          {{ $i }}:00 AM</option>
                        <option value="{{ ($i<10 ? '0' : '').$i }}:30"
                          @if($i.':30 AM' == $workDay->morning_start) selected @endif>
                          {{ $i }}:30 AM</option>
                      @endfor
                    </select>
                  </div>
                  <div class="col">
                    <select class="form-control" name="morning_end[]">
                      @for($i=5; $i<=11; $i++)
                        <option value="{{ ($i<10 ? '0' : '').$i }}:00"
                          @if($i.':00 AM' == $workDay->morning_end) selected @endif>
                          {{ $i }}:00 AM</option>
                        <option value="{{ ($i<10 ? '0' : '').$i }}:30"
                          @if($i.':30 AM' == $workDay->morning_end) selected @endif>
                        {{ $i }}:30 AM</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </th>
              <th>
                <div class="row">
                  <div class="col">
                    <select class="form-control" name="afternoon_start[]">
                      @for($i=1; $i<=11; $i++)
                        <option value="{{ $i+12 }}:00"
                          @if($i.':00 PM' == $workDay->afternoon_start) selected @endif>
                          {{ $i }}:00 PM</option>
                        <option value="{{ $i+12 }}:30"
                          @if($i.':30 PM' == $workDay->afternoon_start) selected @endif>
                          {{ $i }}:30 PM</option>
                      @endfor
                    </select>
                  </div>
                  <div class="col">
                    <select class="form-control" name="afternoon_end[]">
                      @for($i=1; $i<=11; $i++)
                        <option value="{{ $i+12 }}:00"
                          @if($i.':00 PM' == $workDay->afternoon_end) selected @endif>
                          {{ $i }}:00 PM</option>
                        <option value="{{ $i+12 }}:30"
                          @if($i.':30 PM' == $workDay->afternoon_end) selected @endif>
                          {{ $i }}:30 PM</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </th>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      {{-- $doctors->links() --}}
    </div>
  </div>
</form>
<br><br>
@endsection
