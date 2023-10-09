
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('teacher_dashboard')}}">
                            <i class="ti-home"></i>
                            <span class="right-nav-text">{{trans('main.Dashboard')}}</span>
                        </a>
                    </li>


                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">
                        {{trans('main_trans.Program')}}
                    </li>


                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fa fa-check"></i></i><span
                                    class="right-nav-text">{{trans('main.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('teacher.sections.index')}}" target="_blank">{{trans('main.List_sections')}}</a></li>
                        </ul>
                    </li>


                    <!-- students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fa fa-graduation-cap"></i>{{trans('main.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="{{route('teacher.students.index')}}" target="_blank">
                                    {{trans('main.students')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Attendance-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fa fa-line-chart"></i>
                                <span class="right-nav-text">{{trans('main.reports')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{route('teacher.students.attendance_reports')}}">
                                    {{trans('main.Attendance_reports')}}
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Exams-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                            <div class="pull-left"><i class="fa fa-question"></i><span class="right-nav-text">{{trans('main.Exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.quizzes.index')}}">{{trans('main.Exams')}}</a> </li>
                        </ul>
                    </li>


                    <!-- Online classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                            <div class="pull-left"><i class="fa fa-video-camera"></i><span class="right-nav-text">{{trans('main.Onlineclasses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.onlineClasses.index')}}">font Awesome</a> </li>
                        </ul>
                    </li>

                    <!-- profiles-->
                    <li>
                        <a href="{{route('teacher.profiles.index')}}">
                            <i class="fa fa-cog"></i>
                            <span class="right-nav-text">{{trans('main.Teacher_Profile')}} </span>
                        </a>
                    </li>


                </ul>
            </div>
