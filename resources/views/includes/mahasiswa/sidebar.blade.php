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
            <li class="{{ Request::is('*/mahasiswa/*') || Request::is('*/dosen') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('*/krs/*') || Request::is('*/dosen') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.krs-index') }}"><i class="fas fa-tasks"></i>
                    <span>KRS Ku</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
{{-- End Sidebar --}}
