
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('parent_dashboard')}}">
                            <i class="ti-home"></i>
                            <span class="right-nav-text">{{trans('main.Dashboard')}}</span>
                        </a>
                    </li>


                    <!-- students-->
                    <li>
                        <a href="{{route('parent.children.index')}}">
                            <i class="fa fa-child"></i>
                            <span class="right-nav-text">{{trans('main.children')}}</span>
                        </a>
                    </li>




                    <!-- Attendance-->
                    <li>
                        <a href="{{route('parent.children.attendance_reports')}}">
                            <i class="fa fa-area-chart"></i>
                            <span class="right-nav-text">{{trans('main.Attendance_reports')}}</span>
                        </a>
                    </li>


                    <!-- fees-->
                    <li>
                        <a href="{{route('parent.children.fees')}}">
                            <i class="fa fa-money"></i>
                            <span class="right-nav-text">{{trans('main.fees_list')}}</span>
                        </a>
                    </li>



                    <!-- profiles-->
                    <li>
                        <a href="{{route('parent.profiles.index')}}">
                            <i class="fa fa-cog"></i>
                            <span class="right-nav-text">{{trans('main.Teacher_Profile')}} </span>
                        </a>
                    </li>

                </ul>
            </div>
