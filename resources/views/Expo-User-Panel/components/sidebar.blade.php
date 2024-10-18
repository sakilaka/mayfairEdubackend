<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- dashboard --}}
        <li class="nav-item {{ Route::is('user.dashboard') || Route::is('user.profile') ? 'active' : '' }}">
            <a class="nav-link {{ Route::is('user.dashboard') || Route::is('user.profile') ? 'active' : '' }}"
                href="{{ route('user.dashboard') }}">
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- dashboard --}}
        <li class="nav-item {{ Route::is('user.my_tickets') ? 'active' : '' }}">
            <a class="nav-link {{ Route::is('user.my_tickets') ? 'active' : '' }}" href="{{ route('user.my_tickets') }}">
                <i class="fa fa-address-book menu-icon"></i>
                <span class="menu-title">Tickets</span>
            </a>
        </li>
    </ul>
</nav>
