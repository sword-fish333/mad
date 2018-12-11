<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->

<header class="topbar " style="top: 0;">
    <nav class="navbar top-navbar navbar-expand-md custom_navbar">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->

            <ul class="navbar-nav my-lg-0 ml-auto mr-4">
                <!-- ============================================================== -->
                <!-- mega menu -->
                @if(Session::get('ok')!=1)
                    <li class="nav-link mt-3"><strong><a href="/admin/register" style="color:white;" class="lead">Register</a></strong></li>
            @endif

            <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle text-muted waves-effect waves-dark" href=""  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle mt-2" style="font-size:36px; color:white;"></i></a>

                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class=""><i class="fa fa-user" style="font-size:48px"></i></div>

                            @if(Session::get('ok')===1)
                                <div class="m-l-10">
                                    <h4 class="m-b-0">{{  Session::get("user")->name}}</h4>
                                    <p class=" m-b-0">{{  Session::get("user")->email}}</p>
                                </div>
                            @endif
                        </div>
                        @if(Session::get('ok')===1)
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-id-badge m-r-5 m-l-5"></i> {{  Session::get("user")->id}}</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> {{  Session::get("user")->name}}</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> {{  Session::get("user")->email}}</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-mobile m-r-5 m-l-5"></i>  {{  Session::get("user")->phone}}</a>

                        <div class="dropdown-divider"></div>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item logout_dropdpwn" href="/admin/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>

                    </div>

                    @endif
                </li>
                <!-- ============================================================== -->

            </ul>
        </div>
    </nav>
</header>