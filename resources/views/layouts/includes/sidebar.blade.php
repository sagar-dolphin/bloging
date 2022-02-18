<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('front.home') }}" class="brand-link"> --}}
    <a href="javascript:" class="brand-link">
        <img src="{{ asset('/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('/backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
                @if (!empty(Auth::guard('admin')->user()))
                    <img src="{{ asset('storage/profile_images/' . Auth::guard('admin')->user()->profile_image) }}"
                        onerror="this.onerror=null;this.src='{{ asset('backend/dist/img/avatar.png') }}';"
                        class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#"
                    class="d-block">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name : '' }}</a>
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

                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- @hasexactroles('writer|admin'); --}}

                @php
                    // print '<pre>';
                    // print_r(Auth::user()->toArray());
                    // print '<pre>';
                    // exit;
                @endphp

                @hasrole('admin|super-admin')
                    <li class="nav-item {{ request()->is('admin/user*') ? 'menu-open' : '' }}">
                        <a href="javascript:" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="nav-link {{ request()->is('admin/user/create') || request()->is('admin/user/*/edit') ? 'active' : '' }}">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>User List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->is('admin/cms*') ? 'menu-open' : '' }}">
                        <a href="javascript:" class="nav-link {{ request()->is('admin/cms*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                CMS Pages
                                {{-- <i class="fas fa-file"></i> --}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cms.create') }}"
                                    class="nav-link {{ request()->is('admin/cms/create') || request()->is('admin/cms/*/edit') ? 'active' : '' }}">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add CMS Page</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cms.index') }}"
                                    class="nav-link {{ request()->is('admin/cms') ? 'active' : '' }}">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>CMS Page List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasrole

                @hasrole('super-admin')
                    {{-- @if (auth()->user()->hasRole('Admin')) --}}
                    <li class="nav-item {{ request()->is('admin/role*') ? 'menu-open' : '' }}">
                        <a href="javascript:" class="nav-link {{ request()->is('admin/role*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-lock-open"></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.create') }}"
                                    class="nav-link {{ request()->is('admin/role/create') || request()->is('admin/role/*/edit') ? 'active' : '' }}">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="nav-link {{ request()->is('admin/role') ? 'active' : '' }}">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Role List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- @endif --}}
                @endhasrole

                <li class="nav-item {{ request()->is('admin/home-banner*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ request()->is('admin/home-banner*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Home Banner
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home-banner.create') }}"
                                class="nav-link {{ request()->is('admin/home-banner/create') || request()->is('admin/home-banner/*/edit') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Home Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home-banner.index') }}"
                                class="nav-link {{ request()->is('admin/home-banner') ? 'active' : '' }}">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Home Banner List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('admin/property-category*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ request()->is('admin/property-category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shapes"></i>
                        <p>
                            Property Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('property-category.create') }}"
                                class="nav-link {{ request()->is('admin/property-category/create') || request()->is('admin/property-category/*/edit') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Property Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property-category.index') }}"
                                class="nav-link {{ request()->is('admin/property-category') ? 'active' : '' }}">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Property Category List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item {{ request()->is('admin/hotel*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ request()->is('admin/hotel*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            Hotel
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('hotel.create') }}"
                                class="nav-link {{ request()->is('admin/hotel/create') || request()->is('admin/hotel/*/edit') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Hotel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hotel.index') }}"
                                class="nav-link {{ request()->is('admin/hotel') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Hotel List</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item {{ request()->is('admin/hotel*') || request()->is('admin/hotel-banner*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ request()->is('admin/hotel*') || request()->is('admin/hotel-banner*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Hotel Managment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('admin/hotel') || request()->is('admin/hotel/create') || request()->is('admin/hotel/*/edit') ? 'menu-open' : '' }}">
                            <a href="javascript:" class="nav-link {{ request()->is('admin/hotel') || request()->is('admin/hotel/create') || request()->is('admin/hotel/*/edit') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>
                                    Hotel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('hotel.create') }}"
                                        class="nav-link {{ request()->is('admin/hotel/create') || request()->is('admin/hotel/*/edit') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Hotel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('hotel.index') }}"
                                        class="nav-link {{ request()->is('admin/hotel') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Hotel List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item {{ request()->is('admin/hotel-banner*') ? 'menu-open' : '' }}">
                            <a href="javascript:" class="nav-link {{ request()->is('admin/hotel-banner*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    Hotel Banner
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('hotel-banner.create') }}"
                                        class="nav-link {{ request()->is('admin/hotel-banner/create') || request()->is('admin/hotel-banner/*/edit') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Hotel Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('hotel-banner.index') }}"
                                        class="nav-link {{ request()->is('admin/hotel-banner') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Hotel Banner List</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>

                <li class="nav-item {{ request()->is('admin/country*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ request()->is('admin/country*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('admin/country*') ? 'menu-open' : '' }}">
                            <a href="javascript:" class="nav-link {{ request()->is('admin/country*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    Country
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('country.create') }}"
                                        class="nav-link {{ request()->is('admin/country/create') || request()->is('admin/country/*/edit') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Country</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('country.index') }}"
                                        class="nav-link {{ request()->is('admin/country') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Country List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
