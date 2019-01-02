
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <div class="d-flex no-block nav-text-box align-items-center">

        <a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down" href="javascript:void(0)"><i class="mdi mdi-toggle-switch"></i></a>
        <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class=" waves-effect waves-dark" href="/admin/dashboard" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/apartments" aria-expanded="false"><i class="fas fa-building"></i><span class="hide-menu">Apartments</span> <span class="badge badge-pill badge-info float-right">{{\App\Apartment::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/holders" aria-expanded="false"><i class="fas fa-user-lock"></i><span class="hide-menu">Apartments <br> Holders</span> <span class="badge badge-pill badge-info ml-5" >{{\App\ApartmentHolder::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/features" aria-expanded="false"><i class="fas fa-swatchbook"></i><span class="hide-menu">Features of <br> Apartments</span> <span class="badge badge-pill badge-info ml-5" >{{\App\Feature::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/reservations" aria-expanded="false"><i class="fas fa-ticket-alt"></i><span class="hide-menu">Reservations</span> <span class="badge badge-pill badge-info ml-5" >{{\App\Reservation::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/pages" aria-expanded="false"><i class="fab fa-blogger-b"></i><span class="hide-menu">Static Pages</span> <span class="badge badge-pill badge-info ml-5" >{{\App\Blog::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/calendar" aria-expanded="false"><i class="fas fa-calendar-alt"></i><span class="hide-menu">Full Calendar</span> <span class="badge badge-pill badge-info ml-5" >{{\App\Reservation::count()}}</span></a>
                </li>
                <li class="nav-small-cap"></li>
                <li> <a class=" waves-effect waves-dark" href="/admin/admins" aria-expanded="false"><i class="fas fa-users-cog"></i></i><span class="hide-menu">Administrators</span> <span class="badge badge-pill badge-info ml-5" >{{\App\Admin::count()}}</span></a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
