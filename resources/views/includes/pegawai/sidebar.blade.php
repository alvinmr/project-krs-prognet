{{-- Sidebar --}}
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">KRSan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">KRSan</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('*/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('*/mahasiswa/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.mahasiswa.index') }}"><i class="fas fa-users"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-book"></i>
                    <span>Data Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-chalkboard-teacher"></i>
                    <span>Data Dosen</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
{{-- End Sidebar --}}
