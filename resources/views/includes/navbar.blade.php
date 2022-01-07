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
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i
                    class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Kirim Pesan</div>
                <div class="dropdown-list-content dropdown-list-message">
                    @auth('mahasiswa')
                        @foreach ($pegawai as $item)
                            <a href="{{ route('mahasiswa.chat.index', $item->id) }}"
                                class="dropdown-item dropdown-item-read">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="https://source.boringavatars.com/beam/120/{{ $item->nama }}"
                                        class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>{{ $item->nama }}</b>
                                </div>
                            </a>
                        @endforeach
                    @endauth
                    @auth('pegawai')
                        @foreach ($mahasiswa as $item)
                            <a href="{{ route('pegawai.chat.index', $item->id) }}"
                                class="dropdown-item dropdown-item-read">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="https://source.boringavatars.com/beam/120/{{ $item->nama }}"
                                        class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>{{ $item->nama }}</b>
                                </div>
                            </a>
                        @endforeach
                    @endauth
                </div>
            </div>
        </li>
        {{-- <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
        </li> --}}
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @auth('mahasiswa')
                    <img alt="image" src="{{ auth('mahasiswa')->user()->avatar }}" class="mr-1 rounded-circle">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth('mahasiswa')->user()->nama }}
                        ({{ auth('mahasiswa')->user()->nim }})</div>
                @endauth
                @auth('pegawai')
                    <img alt="image" src="https://source.boringavatars.com/beam/120/{{ auth('pegawai')->user()->nama }}"
                        class="mr-1 rounded-circle">
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
