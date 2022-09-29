<aside class="main-sidebar">
    <!-- sidebar-->
    @role('admin')
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li >
                        <a href="{{ route('admin.dashboard')}}">
                            <i class="icon-Home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services')}}">
                            <i class="ti-layers-alt"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.promotions.index')}}">
                            <i class="ti-panel"></i>
                            <span>Promotions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers')}}">
                            <i class="ti-user"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.workshop') }}">
                            <i class="ti-server"></i>
                            <span>Workshops</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.car') }}">
                            <i class="ti-car"></i>
                            <span>Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.about') }}">
                            <i class="ti-folder"></i>
                            <span>About Us</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.policy') }}">
                            <i class="ti-key"></i>
                            <span>Privacy Policy</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    @endrole
    @role('workshop')
    <!-- Workshop Sidebar -->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li >
                        <a href="{{ route('workshop.dashboard')}}">
                            <i class="icon-Home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('workshop.services')}}">
                            <i class="ti-layers-alt"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('workshop.quotes')}}">
                            <i class="ti-layers-alt"></i>
                            <span>My Quotes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('workshop.submited.quotes')}}">
                            <i class="ti-layers-alt"></i>
                            <span>Submited Quotes</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('workshop.bookings')}}">
                            <i class="ti-layers-alt"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    @endrole

</aside>
