<ul class="list-unstyled accordion-menu">
    {{-- <li class="{{ request()->is('admin') ? 'active-page' : '' }}">
                    <a href="{{ route('admin') }}"><i data-feather="home"></i>Dashboard</a>
          </li>
          <li class="sidebar-title">
                    Admin Settings
          </li> --}}
    <li class="{{ request()->is('user*') ? 'active-page' : '' }}">
        <a href="{{ route('user.index') }}"><i data-feather="user"></i>User Management</a>
    </li>
</ul>
