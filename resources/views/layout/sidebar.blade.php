<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ URL::asset('adminlte/dist/img/logo.jpg') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Janji Martahan </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('adminlte/dist/img/fotoku.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Janji Martahan Coffee</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-bullhorn"></i> Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}" 
                               href="{{ route('admin.about.index') }}">
                                <i class="fas fa-bullhorn"></i> About us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.testimoni*') ? 'active' : '' }}" 
                               href="{{ route('admin.testimoni.index') }}">
                                <i class="fas fa-bullhorn"></i> Testimoni
                            </a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" 
                               href="{{ route('admin.contacts.index') }}">
                                <i class="fas fa-bullhorn"></i> Contact
                            </a>
                        </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
