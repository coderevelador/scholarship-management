<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">

            <img src="images/logo.png" alt="Scholarship" width="100px">
            @php
                use App\Models\GeneralSettings;
               
                    $app_name = GeneralSettings::pluck('app_name');
               
            @endphp
            <span class="brand-name">{{ $app_name[0] }}</span>

        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">



                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('home') }}">
                        <i class="mdi mdi-briefcase-account-outline"></i>
                        <span class="nav-text"> Dashboard</span>
                    </a>
                </li>

                @auth
                    @canany(['users.index', 'roles.index'])
                        <li class="section-title">
                            User Management
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#email"
                                aria-expanded="false" aria-controls="email">
                                <i class="fas fa-users-line"></i>
                                <span class="nav-text">Users</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="email" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    @canany(['users.index', 'users.create', 'users.edit', 'users.destroy', 'users.update',
                                        'users.store'])
                                        <li>
                                            <a class="sidenav-item-link" href="{{ route('users.index') }}">
                                                <span class="nav-text">Users</span>
                                            </a>
                                        </li>
                                    @endcanany
                                    @canany(['roles.index', 'roles.create', 'roles.edit', 'roles.destroy', 'roles.update',
                                        'roles.store'])
                                        <li>
                                            <a class="sidenav-item-link" href="{{ route('roles.index') }}">
                                                <span class="nav-text">Roles</span>
                                            </a>
                                        </li>
                                    @endcanany
                                </div>
                            </ul>
                        </li>
                        @canany(['students.index', 'students.create', 'students.edit', 'students.destroy', 'students.update',
                            'students.store'])
                            <li>
                                <a class="sidenav-item-link" href="{{ route('students.index') }}">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span class="nav-text">Students</span>
                                </a>
                            </li>
                        @endcanany
                    @endcanany
                    {{-- scholarship --}}
                    @canany(['scholarship-list.index'])
                        <li class="section-title">
                            Scholarship Management
                        </li>

                        @canany(['scholarship-list.index', 'scholarship-list.create', 'scholarship-list.edit',
                            'scholarship-list.destroy', 'scholarship-list.update', 'scholarship-list.store'])
                            <li>
                                <a class="sidenav-item-link" href="{{ route('scholarship-list.index') }}">
                                    <i class="fa-sharp fa-solid fa-layer-group"></i>
                                    <span class="nav-text">Scholarship List</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['apply.scholarship.all'])
                            <li>
                                <a class="sidenav-item-link" href="{{ route('apply.scholarship.all') }}">
                                    <i class="mdi mdi-equal-box"></i>
                                    <span class="nav-text">Applied Scholarships</span>
                                </a>
                            </li>
                        @endcanany
                    @endcanany


                    @canany(['academic-year.index', 'school.index', 'department.index', 'course.index', 'division.index',
                        'eligibility.index'])
                        <li class="section-title">
                            Basic Configuration
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#configuration" aria-expanded="false" aria-controls="email">
                                <i class="fas fa-gear"></i>
                                <span class="nav-text">Configuration</span> <b class="caret"></b>
                            </a>
                        @endcanany
                        <ul class="collapse" id="configuration" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                @canany(['academic-year.index', 'academic-year.create', 'academic-year.edit',
                                    'academic-year.destroy', 'academic-year.update', 'academic-year.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('academic-year.index') }}">
                                            <span class="nav-text">Academic Year</span>
                                        </a>
                                    </li>
                                @endcanany
                                @canany(['school.index', 'school.create', 'school.edit', 'school.destroy', 'school.update',
                                    'school.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('school.index') }}">
                                            <span class="nav-text">School/College</span>
                                        </a>
                                    </li>
                                @endcanany

                                @canany(['department.index', 'department.create', 'department.edit', 'department.destroy',
                                    'department.update', 'department.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('department.index') }}">
                                            <span class="nav-text">Department</span>
                                        </a>
                                    </li>
                                @endcanany

                                @canany(['course.index', 'course.create', 'course.edit', 'course.destroy', 'course.update',
                                    'course.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('course.index') }}">
                                            <span class="nav-text">Course/Class</span>
                                        </a>
                                    </li>
                                @endcanany

                                @canany(['division.index', 'division.create', 'division.edit', 'division.destroy',
                                    'division.update', 'division.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('division.index') }}">
                                            <span class="nav-text">Division/Section</span>
                                        </a>
                                    </li>
                                @endcanany
                                @canany(['eligibility.index', 'eligibility.create', 'eligibility.edit',
                                    'eligibility.destroy', 'eligibility.update', 'eligibility.store'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('eligibility.index') }}">
                                            <span class="nav-text">Eligibility Checker</span>
                                        </a>
                                    </li>
                                @endcanany

                            </div>
                        </ul>
                    </li>

                    @canany(['general-settings.index'])
                        <li class="section-title">
                            Settings
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#settings" aria-expanded="false" aria-controls="email">
                                <i class="mdi mdi-settings-outline"></i>
                                <span class="nav-text">Settings</span> <b class="caret"></b>
                            </a>
                        @endcanany
                        <ul class="collapse" id="settings" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                @canany(['general-settings.index'])
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('general-settings.index') }}">
                                            <span class="nav-text">General Settings</span>
                                        </a>
                                    </li>
                                @endcanany
                            </div>
                        </ul>
                    </li>

                @endauth

                @role('Student')
                    <li>
                        <a class="sidenav-item-link" href="{{ route('apply-scholarship.index') }}">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="nav-text">Apply Scholarship</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidenav-item-link" href="{{ route('applied.status.scholarship', Auth::user()->id) }}">
                            <i class="fas fa-info-circle"></i>
                            <span class="nav-text">Scholarship Status</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidenav-item-link" href="{{ route('student.education') }}">
                            <i class="fas fa-book-reader"></i>
                            <span class="nav-text">Educational Details</span>
                        </a>
                    </li>
                @endrole

            </ul>

        </div>

        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <ul class="d-flex">
                    <li>
                        <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i
                                class="mdi mdi-settings"></i></a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" data-toggle="tooltip" title="Log Out"><i
                                class="mdi mdi-logout"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>



<!-- ====================================
    ——— PAGE WRAPPER
    ===================================== -->
<div class="page-wrapper">

    <!-- Header -->
    <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <!-- Sidebar toggle button -->
            <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
            </button>

            {{-- <span class="page-title">dashboard</span> --}}

            <div class="navbar-right ">


                <ul class="nav navbar-nav">

                    <!-- User Account -->
                    <li class="dropdown user-menu">
                        <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <img src="{{ asset('/images/user/' . Auth::user()->image) }}"
                                class="user-image rounded-circle" alt="User Image" />
                            <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a class="dropdown-link-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                    <i class="mdi mdi-account-outline"></i>
                                    <span class="nav-text">My Profile</span>
                                </a>
                            </li>

                            <li class="dropdown-footer">
                                <a class="dropdown-link-item" href="{{ route('logout') }}"> <i
                                        class="mdi mdi-logout"></i> Log
                                    Out </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


    </header>
