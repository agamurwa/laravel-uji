{{--  <!-- Navbar  -->  --}}
<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('../frontend/images/klinik.png') }}" alt="Logo Klinik">
        </a>
        <button 
            class="navbar-toggler navbar-toggler-right" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navb"
        >

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a href="{{ url('/') }}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop"
                        data-toggle="dropdown">Profil</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Sejarah</a>
                            <a href="#" class="dropdown-item">Visi Misi</a>
                        </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop"
                        data-toggle="dropdown">Pelayanan</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('rawat-jalan') }}" class="dropdown-item">Layanan Rawat Jalan</a>
                            <a href="{{ url('jadwal') }}" class="dropdown-item">Jadwal Dokter</a>
                            {{--  <a href="#" class="dropdown-item">Tarif Pelayanan</a>  --}}
                        </div>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#footer" class="nav-link">Kontak</a>
                </li>

                @guest
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbardrop"
                            data-toggle="dropdown">Rekam Medis</a>
                            <div class="dropdown-menu">
                                <a href="{{ url('office')}}" class="dropdown-item">Login</a>
                            </div>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Rekam Medis</a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/logout')}}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</div>