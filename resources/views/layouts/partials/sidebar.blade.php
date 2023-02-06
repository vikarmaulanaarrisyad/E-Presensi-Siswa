<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="index3.html" class="brand-link bg-primary">
        <img src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('tahun-ajaran.index') }}"
                            class="nav-link {{ routeActive(['tahun-ajaran.index']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Tahun Pelajaran
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('kelas.index') }}" class="nav-link {{ routeActive(['kelas.index']) }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Data Kelas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kesiswaan.index') }}"
                            class="nav-link {{ routeActive(['kesiswaan.index']) }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Siswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Data Guru
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Absensi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-book "></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="document.querySelector('#form-logout').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i> Keluar
                    </a>

                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

    </div>
</aside>
