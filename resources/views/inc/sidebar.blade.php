<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{route('home')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" srcset="" style="height:3rem !important;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{Request::is('/') ? 'active' : ''}} {{Request::is('home') ? 'active' : ''}}">
                    <a href="{{route('home')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{Request::is('customer/*') ? 'active' : ''}} has-sub">
                    <a href="#" class="sidebar-link ">
                        <i class="bi bi-people"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('customer.add')}}">Add Customer</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('customer.all')}}">All Customers</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Leasing</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="">Leasing form</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Accounts</li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-receipt"></i>
                        <span>Puchase</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('purchase.add')}}">Add purchasing</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"  class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
