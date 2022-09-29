<aside class="main-sidebar">
    <!-- sidebar-->
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


                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span>Log Out</span>

                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
