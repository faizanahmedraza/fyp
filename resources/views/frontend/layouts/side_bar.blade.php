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
            <li class="dropdown"><a href="javascript:void(0);"> Project</a>
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
                    <li class="{{ getActiveClass(request()->segment(2),['funds']) }}"><a
                                class="text-nowrap" href="/user/apply-for-funds"><i
                                    class="fas fa-scroll fa-fw"></i>Funds</a></li>
                    <li class="{{ getActiveClass(request()->segment(2),['submissions']) }}"><a
                                class="text-nowrap" href="/user/project-submissions"><i
                                    class="fas fa-scroll fa-fw"></i>Project Submissions</a></li>
                </ul>
            </li>
            @can('user-event-list')
                <li class="dropdown">
                    <ul>
                        <li class="{{ getActiveClass(request()->segment(2),['events']) }}">
                            <a href="/user/events">
                                <i class="fas fa-calendar-day fa-fw"></i> Events</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="dropdown">
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
