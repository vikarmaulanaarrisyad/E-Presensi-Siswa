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

                    {{-- <li class="nav-item {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Sarana Prasarana
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview"
                            style="{{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) ? '' : 'display: none;' }}">
                            <li class="nav-item">
                                <a href="{{ route('kesiswaan.index', 'kesiswaan.detail') }}"
                                    class="nav-link {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Ruangan</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}


                    <li class="nav-item {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Siswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview"
                            style="{{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) ? '' : 'display: none;' }}">
                            <li class="nav-item">
                                <a href="{{ route('kesiswaan.index', 'kesiswaan.detail') }}"
                                    class="nav-link {{ routeActive(['kesiswaan.index', 'kesiswaan.detail']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Mutasi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Mutasi Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Mutasi Masuk</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Akademik
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{ route('kenaikan-siswa.index') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Kenaikan Kelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Kelulusan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Daftar Alumni</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
                        <a href="{{ route('rombel.index') }}"
                            class="nav-link {{ routeActive(['rombel.index', 'rombel.detail']) }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Rombongan Belajar
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Presensi
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
