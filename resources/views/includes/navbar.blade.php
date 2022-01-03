{{-- Navbar --}}
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="mr-auto form-inline">
        <ul class="mr-3 navbar-nav">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
        </li>
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="https://source.boringavatars.com/beam" class="mr-1 rounded-circle">
                @auth('mahasiswa')
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth('mahasiswa')->user()->nama }}
                        ({{ auth('mahasiswa')->user()->nim }})</div>
                @endauth
                @auth('pegawai')
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth('pegawai')->user()->nama }}</div>
                @endauth
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <form action="{{ route('mahasiswa.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item ">
                        <div class="has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </div>
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
{{-- End Navbar --}}
