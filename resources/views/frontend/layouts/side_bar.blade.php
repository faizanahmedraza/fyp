<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown">
                <ul>
                    <li class="{{ getActiveClass(request()->segment(2),['dashboard']) }}">
                        <a href="/user/dashboard">
                            <i class="icon-rocket fa-fw"></i> Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <ul>
                    <li class="{{ getActiveClass(request()->segment(2),['view']) }}">
                        <a href="/user/view-profile">
                            <i class="fa fa-user fa-fw"></i> Profile</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> Proposal</a>
                <ul>
                    <li class="{{ (request()->is('user/fyp-proposals*')) ? 'active' : '' }}"><a
                                class="text-nowrap" href="/user/fyp-proposals"><i
                                    class="fas fa-scroll fa-fw"></i>Fyp Proposals</a></li>
                    <li class="{{ (request()->is('user/funded-proposals*')) ? 'active' : '' }}"><a
                                class="text-nowrap" href="/user/funded-proposals"><i
                                    class="fas fa-scroll fa-fw"></i>Funded Proposals</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0);"> Project</a>
                <ul>
                    <li class="{{ (request()->is('user/fyp-projects*')) ? 'active' : '' }}"><a
                                class="text-nowrap" href="/user/fyp-projects"><i
                                    class="fas fa-scroll fa-fw"></i>Fyp Projects</a></li>
                    <li class="{{ (request()->is('user/funded-projects*')) ? 'active' : '' }}"><a
                                class="text-nowrap" href="/user/funded-projects"><i
                                    class="fas fa-scroll fa-fw"></i>Funded Projects</a></li>
                </ul>
            </li>
            @can('user-event-list')
                <li class="dropdown"><a href="javascript:void(0);">Events</a>
                    <ul>
                        <li class="{{ getActiveClass(request()->segment(2),['events']) }}">
                            <a href="/user/events">
                                <i class="fas fa-calendar-day fa-fw"></i> Events</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="dropdown"><a href="javascript:void(0);">Internships</a>
                <ul>
                    <li class="{{ getActiveClass(request()->segment(2),['internships']) }}">
                        <a href="/user/internships">
                            <i class="far fa-book"></i> Internships</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END: Menu-->
    </div>
</div>
