<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('admins/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="" class="d-block">
          @auth('admin')
              <span><b>{{ ucfirst(auth()->user()->name) }}</b></span><br>
              <span><small class="fa fa-circle text-success"></small> online</span>
          @endauth
        </a>
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
        <li class="nav-item menu-open">
          <a href="/admin" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/users" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p class="text">Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/categories" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Categories</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/tags" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Tags</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/posts" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Posts</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/roles" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Roles</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/admin/permissions" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Permissions</p>
          </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>