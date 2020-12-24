<!-- Navigation -->
<!-- Heading -->
@if(auth()->user()->role == 'admin')
  <h6 class="navbar-heading text-muted">Gestionar Datos</h6>
@else
  <h6 class="navbar-heading text-muted">Menú</h6>
@endif
<ul class="navbar-nav">
  @if(auth()->user()->role == 'admin')

      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="ni ni-tv-2 text-primary"></i> Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('specialties.index') }}">
          <i class="ni ni-briefcase-24 text-blue"></i> Especialidades
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('doctors.index') }}">
          <i class="ni ni-badge text-orange"></i> Médicos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('patients.index') }}">
          <i class="ni ni-satisfied text-yellow"></i> Pacientes
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./examples/tables.html">
          <i class="ni ni-calendar-grid-58 text-info"></i> Horarios
        </a>
      </li>
  @elseif(auth()->user()->role == 'doctor')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('schedule.edit') }}">
          <i class="ni ni-badge text-orange"></i> Gestionar horario
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('patients.index') }}">
          <i class="ni ni-satisfied text-yellow"></i> Mis citas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./examples/tables.html">
          <i class="ni ni-calendar-grid-58 text-info"></i> Mis pacientes
        </a>
      </li>
    @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('appointments.create') }}">
          <i class="ni ni-send text-yellow"></i> Reservar cita
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./examples/tables.html">
          <i class="ni ni-calendar-grid-58 text-info"></i> Mis citas
        </a>
      </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25"></i> Cerrar Sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
      @csrf
    </form>
  </li>
</ul>
@if(auth()->user()->role == 'admin')
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Reportes</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
        <i class="ni ni-collection text-red"></i> Frecuencia de Citas
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
        <i class="ni ni-spaceship text-success"></i> Médicos más Activos
      </a>
    </li>
  </ul>
@endif