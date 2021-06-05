<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="active">
                <a href="/admin/dashboard">
                    <i class="icon-rocket"></i> Dashboard</a>
            </li>
            @can('user-list')
                <li class="dropdown"><a href="javascript:void(0);"><i class="fas fa-users"></i></i> User Management</a>
                    <ul>
                        <li><a href="/admin/manage-users"><i class="fas fa-user"></i> Users</a></li>
                        <li><a href="/admin/manage-roles"><i class="fas fa-user-tag"></i> Roles</a></li>
                    </ul>
                </li>
            @endcan
            <li class="dropdown"><a href="javascript:void(0);"><i class="fas fa-book-open"></i> Submitted Projects</a>
                <ul>
                    @can('research-project-list')
                        <li><a class="text-nowrap" href="/admin/studewnt/research-projects"><i class="fas fa-grid"></i>
                                Research Project</a></li>
                    @endcan
                </ul>
            </li>
            @can('notification-list')
                <li><a href="/admin/notifications"><i class="icon-bag mr-1"></i> Notifications</a></li>
            @endcan
            @can('upload-sample-list')
            <li><a href="/admin/upload-samples"><i class="fas fa-book-open"></i> Upload Projects</a>
                <ul>
                    <li><a class="text-nowrap" href="/admin/student/add-research-project-template"><i
                                    class="fas fa-grid"></i>
                            Research Project</a></li>
                </ul>
            </li>
            @endcan
            <li class="dropdown"><a href="javascript:void(0);"><i class="icon-bag mr-1"></i> Website Content
                    Management</a>
                <ul>
                    <li><a href="/admin/frontend/pages/home"><i class="icon-grid"></i> Home </a></li>
                </ul>
            </li>
            <!-- END: Menu-->
    </div>
</div>
