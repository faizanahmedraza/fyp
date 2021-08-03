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
                    @can(['student-project-proposal-list'])
                        <li class="{{ getActiveClass(request()->segment(2),['student']) }}"><a class="text-nowrap"
                                                                                               href="/user/student-research-proposals"><i
                                        class="fas fa-scroll fa-fw"></i>
                                Submit Proposal</a></li>
                    @endcan
                    @can(['researcher-project-proposal-list'])
                        <li class="{{ getActiveClass(request()->segment(2),['researcher']) }}"><a class="text-nowrap"
                                                                                                  href="/user/researcher-research-proposals"><i
                                        class="fas fa-scroll fa-fw"></i>
                                Submit Proposal</a></li>
                    @endcan
                    @can(['focal-person-project-proposal-list'])
                        <li class="{{ getActiveClass(request()->segment(2),['focal']) }}"><a class="text-nowrap"
                                                                                             href="/user/focal-person-research-proposals"><i
                                        class="fas fa-scroll fa-fw"></i>
                                Submit Proposal</a></li>
                    @endcan
                    @can(['faculty-project-proposal-list'])
                        <li class="{{ getActiveClass(request()->segment(2),['faculty']) }}"><a class="text-nowrap"
                                                                                               href="/user/faculty-research-proposals"><i
                                        class="fas fa-scroll fa-fw"></i>
                                Submit Proposal</a></li>
                    @endcan
                    @can(['oric-member-project-proposal-list'])
                        <li class="{{ getActiveClass(request()->segment(2),['oric']) }}"><a class="text-nowrap"
                                                                                            href="/user/oric-member-research-proposals"><i
                                        class="fas fa-scroll fa-fw"></i>
                                Submit Proposal</a></li>
                    @endcan
                </ul>
            </li>
            @can('user-event-list')
                <li class="dropdown">
                    <ul>
                        <li class="{{ getActiveClass(request()->segment(2),['events','event']) }}">
                            <a href="/user/events">
                                <i class="fas fa-calendar-day fa-fw"></i> Events</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
        <!-- END: Menu-->
    </div>
</div>
