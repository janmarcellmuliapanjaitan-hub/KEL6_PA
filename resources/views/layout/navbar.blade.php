<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">

        <!-- Sidebar toggle -->
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <!-- Home -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                Home
            </a>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notification -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-bell"></i>
            </a>
        </li>


        <!-- User Dropdown -->
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" 
               data-toggle="dropdown" 
               href="#">

                <i class="bi bi-person-circle mr-2"></i>
                {{ Auth::user()->name ?? 'Admin' }}

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <a href="#" class="dropdown-item">
                    Profile
                </a>

                <a href="#" class="dropdown-item">
                    Settings
                </a>

                <div class="dropdown-divider"></div>

                <a href="#"
                   class="dropdown-item text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </div>

        </li>

    </ul>

</nav>