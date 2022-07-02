<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">Klinik PMB Lestari</div>
        {{--  <div class="sidebar-brand-text mx-3">Mom Love Baby SPA</div>  --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@if (auth()->user()->profesi=='Staff')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
        <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Pendaftaran</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pendaftaran.index') }}">Pendaftaran Pasien</a>
                <a class="collapse-item" href="{{ route('data-pendaftaran.index') }}">Data Pendaftaran Pasien</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Rekam Medis</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('add-rekam-medis.index') }}">Tambah Rekam Medis</a>
                <a class="collapse-item" href="{{ route('rekam-medis.index') }}">Data Rekam Medis</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-pasien.index') }}">
            <i class="fas fa-fw fa fa-users"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-dokter.index') }}">
            <i class="fas fa-fw fa fa-user-md"></i>
            <span>Data Dokter</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('obat.index') }}">
            <i class="fas fa-fw fa fa-medkit"></i>
            <span>Data Obat</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('gallery.index') }}" hidden>
            <i class="fas fa-fw fa fa-images"></i>
            <span>Profil Dokter</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('jadwal-dokter.index') }}" hidden>
            <i class="fas fa-fw fa fa-book"></i>
            <span>Jadwal Dokter</span></a>
    </li>
@if (Auth::user()->roles == 1)
    <!-- Divider -->
        <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Tambahan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengguna.index') }}">
            <i class="fas fa-fw fa fa-user"></i>
            <span>Pengguna</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profil-klinik.index') }}">
            <i class="fas fa-fw fa fa-cog"></i>
            <span>Profil Klinik</span></a>
    </li>
@endif

@elseif (auth()->user()->profesi=='Dokter')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
        <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Rekam Medis
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Rekam Medis</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('add-rekam-medis.index') }}">Tambah Rekam Medis</a>
                <a class="collapse-item" href="{{ route('rekam-medis.index') }}">Data Rekam Medis</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-pasien.index') }}">
            <i class="fas fa-fw fa fa-users"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('obat.index') }}">
            <i class="fas fa-fw fa fa-medkit"></i>
            <span>Data Obat</span></a>
    </li>
@endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{--  <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>  

</ul>
<!-- End of Sidebar -->