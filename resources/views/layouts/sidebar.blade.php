<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('/assets/img/user.png') }}" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">
                    @if (!empty(auth()->user()->nama))
                        {{ auth()->user()->nama }}
                    @else
                        User
                    @endif
                </span>
                <span class="profession">{{auth()->user()->role}}</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            {{-- <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
            </li> --}}

            <ul class="menu-links">
                <li class="nav-link {{ request()->is('perjalanan') ? 'active' : '' }}">
                    <a href="/perjalanan">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-link {{ request()->is('perjalanan/form') ? 'active' : '' }}">
                    <a href="/perjalanan/form">
                        <i class='bx bx-plus-medical icon'></i>
                        <span class="text nav-text">Tambah Data</span>
                    </a>
                </li>


            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="/logout" onclick="return confirm('Anda yakin untuk logout dari akun {{ auth()->user()->nama }} ?')"">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>

            {{-- <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li> --}}

        </div>
    </div>

</nav>

