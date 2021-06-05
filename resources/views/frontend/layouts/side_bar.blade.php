<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="active">
                <a href="/student/dashboard">
                    <i class="icon-rocket"></i> Dashboard</a>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"><i class="fas fa-book-open"></i> Submitted Projects</a>
                <ul>
                    @can('student-research-project-list')
                        <li><a class="text-nowrap" href="/student/research-projects"><i class="fas fa-grid"></i>
                                Research Project</a></li>
                    @endcan
                </ul>
            </li>
            @can('student-notification-list')
                <li><a href="/student/notifications"><i class="icon-bag mr-1"></i> Notifications</a></li>
            @endcan
        </ul>
        <!-- END: Menu-->
    </div>
</div>
