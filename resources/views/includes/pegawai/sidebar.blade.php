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
            <li class="{{ Request::is('*/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="{{ Request::is('*/mahasiswa/*') || Request::is('*/mahasiswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.mahasiswa.index') }}"><i class="fas fa-users"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li class="{{ Request::is('*/matakuliah/*') || Request::is('*/matakuliah') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.matakuliah.index') }}"><i
                        class="fas fa-book"></i>
                    <span>Data Mata Kuliah</span>
                </a>
            </li>
            <li class="{{ Request::is('*/dosen/*') || Request::is('*/dosen') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.dosen.index') }}"><i
                        class="fas fa-chalkboard-teacher"></i>
                    <span>Data Dosen</span>
                </a>
            </li>
            <li class="{{ Request::is('*/tahunajaran/*') || Request::is('*/tahunajaran') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.tahunajaran-index') }}"><i
                        class="fas fa-calendar"></i>
                    <span>Data Tahun Ajaran</span>
                </a>
            </li>
            <li class="menu-header">KRS</li>
            <li class="{{ Request::is('*/krs/*') || Request::is('*/krs') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.krs-index') }}"><i class="fas fa-book"></i>
                    <span>Data KRS Mahasiswa</span>
                </a>
            </li>
            <li class="{{ Request::is('*/input-nilai/*') || Request::is('*/input-nilai') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.input-nilai.index') }}"><i
                        class="fas fa-tasks"></i>
                    <span>Input Nilai</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
{{-- End Sidebar --}}
