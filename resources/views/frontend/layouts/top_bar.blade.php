<div id="header-fix" class="header fixed-top">
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar d-flex justify-content-center pt-2">
                <a href="/user/dashboard" class="horizontal-logo">
                    <img src="/assets/website/images/logo.png" alt="" width="100pt">
                </a>
            </div>
            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
            </div>
            <div class="pl-3" id="orgName"><h4>{{ strtoupper('juw oric management portal') }}</h4></div>
            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li class="dropdown align-self-center d-inline-block">
                        <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right border  py-0" id="statusNotification">
                            @include('partials.notifications.student')
                            <li><a class="dropdown-item text-center py-2" href="/user/notifications"> Read All Message
                                    <i class="icon-arrow-right pl-2 small"></i></a></li>
                        </ul>
                    </li>

                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="javascript:void(0)" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <img src="/assets/images/user_profile/@if(Auth::user()->profile_picture){{ Auth::user()->profile_picture }}@else not_available.jpg @endif" alt=""
                                     class="d-flex img-fluid rounded-circle" style="width: 35px; height: 35px; object-fit: fill;">
                            </div>
                        </a>

                        <div class="dropdown-menu border dropdown-menu-right p-0">
                            <a class="dropdown-item px-2 text-dark align-self-center d-flex"
                               href="javascript:void(0)"><i class="fas fa-user fa-fw mr-1 h6 mb-0"></i> {{Auth::user()->full_name}} ( {{ ucwords(str_replace('-',' ',Auth::user()->roles()->pluck('name')->first())) }} ) </a>
                            <a class="dropdown-item px-2 text-dark align-self-center d-flex"
                               href="/user/manage-profile"><i class="fas fa-user-edit mr-1 h6 mb-0"></i> Edit
                                Profile</a>
                            <a href="/user/logout" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <i class="fas fa-sign-out-alt mr-2 h6 mb-0"></i> Sign Out</a>
                        </div>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
