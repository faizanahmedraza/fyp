<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="javascript:void(0);"> Dashboard</a>
                <ul>
                    <li class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                        <a href="/admin/dashboard">
                            <i class="icon-rocket"></i> Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> User Management</a>
                <ul>
                    @can('user-list')
                        <li class="{{ request()->segment(2) == 'manage-users' ? 'active' : '' }}"><a
                                    href="/admin/manage-users"><i class="fas fa-user"></i> Users</a></li>
                    @endcan
                    @can('role-list')
                        <li class="{{ request()->segment(2) == 'manage-roles' ? 'active' : '' }}"><a
                                    href="/admin/manage-roles"><i class="fas fa-user-tag"></i> Roles</a></li>
                    @endcan
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> Submitted Projects</a>
                <ul>
                    @can('research-project-list')
                        <li class="{{ request()->segment(3) == 'research-projects' ? 'active' : '' }}"><a
                                    class="text-nowrap" href="/admin/student/research-projects"><i
                                        class="fas fa-scroll"></i>
                                Research Project</a></li>
                    @endcan
                </ul>
            </li>
            @can('notification-list')
                <li class="dropdown"><a href="javascript:void(0);"> Submitted Projects</a>
                    <ul>
                        <li class="{{ request()->segment(2) == 'notifications' ? 'active' : '' }}"><a href="/admin/notifications"><i class="icon-bag mr-1"></i> Notifications</a></li>
                    </ul>
                </li>
            @endcan
            @can('upload-sample-list')
                <li><a href="/admin/upload-samples"> Upload Projects</a>
                    <ul>
                        <li class="{{ request()->segment(3) == 'add-research-project-template' ? 'active' : '' }}"><a
                                    class="text-nowrap" href="/admin/student/add-research-project-template"><i
                                        class="far fa-upload"></i>
                                Research Project</a></li>
                    </ul>
                </li>
            @endcan
            <li class="dropdown"><a href="javascript:void(0);"> Website Content
                    Management</a>
                <ul>
                    <li class="{{ request()->segment(2) == 'home' ? 'active' : '' }}"><a href="/admin/frontend/pages/home"><i class="icon-grid"></i> Home </a></li>
                    <li class="{{ request()->segment(2) == 'contact' ? 'active' : '' }}"><a href="/admin/frontend/pages/contact"><i class="icon-grid"></i> Contact </a></li>
                    <li class="{{ request()->segment(2) == 'research' ? 'active' : '' }}"><a href="/admin/frontend/pages/research"><i class="icon-grid"></i> Research </a></li>
                    <li class="{{ request()->segment(2) == 'about-us' ? 'active' : '' }}"><a href="/admin/frontend/pages/about-us"><i class="icon-grid"></i> About Us </a></li>
                    <li class="{{ request()->segment(2) == 'our-news' ? 'active' : '' }}"><a href="/admin/frontend/pages/our-news"><i class="icon-grid"></i> Our News </a></li>
                    <li class="{{ request()->segment(2) == 'our-professors' ? 'active' : '' }}"><a href="/admin/frontend/pages/our-professors"><i class="icon-grid"></i> Our Professors </a></li>
                </ul>
            </li>
        </ul>
        <!-- END: Menu-->
    </div>
</div>
