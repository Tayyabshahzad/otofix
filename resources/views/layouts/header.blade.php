<header class="main-header" style="width: 100%">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <a href="#"
            class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent hover-primary"
            data-toggle="push-menu" role="button">
            <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span></span>
        </a>
        <!-- Logo -->
        <a href="" class="logo">
            <!-- logo-->
            <div class="logo-lg">
                <span class="light-logo"><img src="{{ asset('storage/images/logo-dark-text.png') }}" alt="logo"></span>
                <span class="dark-logo"><img src="{{ asset('storage/images/logo-light-text.png') }}" alt="logo"></span>
            </div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item d-md-none">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-info-light"
                        data-toggle="push-menu" role="button">
                        <span class="icon-Align-left"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></span>
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <form>
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search"
                                        aria-label="Search" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" id="button-addon3"><i
                                                class="ti-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <li class="btn-group nav-item d-lg-inline-flex d-none">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link full-screen btn-info-light"
                        title="Full Screen">
                        <i class="icon-Expand-arrows"><span class="path1"></span><span
                                class="path2"></span></i>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <span class="label label-primary">5</span>
                    <a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light"
                        data-bs-toggle="dropdown" title="Notifications">
                        <i class="icon-Notifications"><span class="path1"></span><span
                                class="path2"></span></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifications</h4>
                                    </div>
                                    <div>
                                        <a href="#" class="text-danger">Clear All</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu sm-scrol">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc
                                        suscipit blandit.
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li>


                <!-- Control Sidebar Toggle Button -->

                <!-- Right Sidebar Toggle Button -->
                <li class="btn-group nav-item d-xl-none d-inline-flex">
                    <a href="#"
                        class="push-btn right-bar-btn waves-effect waves-light nav-link full-screen btn-info-light">
                        <span class="icon-Layout-left-panel-1"><span class="path1"></span><span
                                class="path2"></span></span>
                    </a>
                </li>
                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle p-0 text-dark hover-primary ms-md-30 ms-10"
                        data-bs-toggle="dropdown" title="User">
                        <span class="ps-30 d-md-inline-block d-none">Hello,</span> <strong
                            class="d-md-inline-block d-none"> {{ Auth::user()->name}}  - {{ ucfirst(Auth::user()->roles()->pluck('name')->implode(' '))}}</strong><img
                            src="{{ asset('storage/images/avatar/avatar-11.png') }}"
                            class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i>  Profile</a>

                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="logout()">
                                <span>Log Out</span>
                            </a>
                            <form method="POST" id="logoutform" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
