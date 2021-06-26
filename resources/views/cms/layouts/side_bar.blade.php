<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="javascript:void(0);"> Dashboard</a>
                <ul>
                    <li class="{{ getActiveClass(request()->segment(2),['dashboard']) }}">
                        <a href="/admin/dashboard">
                            <i class="icon-rocket"></i> Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> User Management</a>
                <ul>
                    @can('user-list')
                        <li class="{{ getActiveClass(request()->segment(2),['users','user']) }}"><a
                                    href="/admin/manage-users"><i class="fas fa-user"></i> Users</a></li>
                    @endcan
                    @can('role-list')
                        <li class="{{ getActiveClass(request()->segment(2),['roles','role']) }}"><a
                                    href="/admin/manage-roles"><i class="fas fa-user-tag"></i> Roles</a></li>
                    @endcan
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> Submitted Projects</a>
                <ul>
                    @can('research-project-list')
                        <li class="{{ getActiveClass(request()->segment(3),['projects','research']) }}"><a
                                    class="text-nowrap" href="/admin/student/research-projects"><i
                                        class="fas fa-scroll"></i>
                                Research Project</a></li>
                    @endcan
                </ul>
            </li>
            @can('notification-list')
                <li class="dropdown"><a href="javascript:void(0);"> Notifications</a>
                    <ul>
                        <li class="{{ getActiveClass(request()->segment(2),['notifications']) }}"><a href="/admin/notifications"><i class="icon-bag mr-1"></i> Notifications</a></li>
                    </ul>
                </li>
            @endcan
            @can('upload-sample-list')
                <li class="dropdown"><a href="javascript:void(0);"> Upload Projects</a>
                    <ul>
                        <li class="{{ getActiveClass(request()->segment(2),['samples']) }}"><a href="/admin/upload-samples"><i
                                        class="far fa-upload"></i> Upload Projects</a></li>
                        <li class="{{ getActiveClass(request()->segment(3),['template','rp']) }}"><a
                                    class="text-nowrap" href="/admin/student/add-rp-template"><i
                                        class="far fa-upload"></i>
                                Research Project</a></li>
                    </ul>
                </li>
            @endcan

            <li class="dropdown @if(getActiveClass(request()->segment(4),['main']) == "active") {{ getActiveClass(request()->segment(4),['main']) }}  @else {{ getActiveClass(request()->segment(5),['aim']) }} @endif"><a href="javascript:void(0);"> Website Content
                    Management</a>
                <ul>
                    <li class="dropdown @if(getActiveClass(request()->segment(4),['main']) == "active") {{ getActiveClass(request()->segment(4),['main']) }}  @else {{ getActiveClass(request()->segment(5),['aim']) }} @endif"><a href="javascript:void(0);"><i class="icon-grid"></i> Home Page </a>
                        <ul class="sub-menu">
                            <li class="{{getActiveClass(request()->segment(4),['main'])}}"><a href="/admin/website/pages/main-home"><i class="icon-grid"></i> Home </a></li>
                            <li class="{{ getActiveClass(request()->segment(5),['aim']) }}"><a href="/admin/website/pages/home/aim-intro"><i class="icon-grid"></i> Mission/Vision </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/admin/website/pages/home/oric-member"><i class="icon-grid"></i> Upload ORIC Member </a></li>
                    <li class=""><a href="/admin/website/pages/home/testimonial"><i class="icon-grid"></i> Upload Testimonial </a></li>
                    <li class="{{ getActiveClass(request()->segment(4),['contact']) }}"><a href="/admin/website/pages/contact"><i class="icon-grid"></i> Contact </a></li>
                    <li class="{{ getActiveClass(request()->segment(4),['research']) }}"><a href="/admin/website/pages/research"><i class="icon-grid"></i> Research </a></li>
                    <li class="{{ getActiveClass(request()->segment(4),['about-us']) }}"><a href="/admin/website/pages/about-us"><i class="icon-grid"></i> About Us </a></li>
                    <li class="{{ getActiveClass(request()->segment(4),['our-news']) }}"><a href="/admin/website/pages/our-news"><i class="icon-grid"></i> Our News </a></li>
                    <li class="{{ getActiveClass(request()->segment(4),['our-professors']) }}"><a href="/admin/website/pages/our-professors"><i class="icon-grid"></i> Our Professors </a></li>
                </ul>
            </li>
        </ul>
        <!-- END: Menu-->
    </div>
</div>
