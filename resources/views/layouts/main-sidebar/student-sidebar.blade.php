
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('student_dashboard')}}">
                            <i class="ti-home"></i>
                            <span class="right-nav-text">{{trans('main.Dashboard')}}</span>
                        </a>
                    </li>


                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">
                        {{trans('main_trans.Programname')}}
                    </li>


                    <!-- library-->
                    <li>
                     <a href="{{route('student.library.index')}}">
                        <i class="fa fa-book"></i>
                         <span class="right-nav-text">{{trans('main.library')}}</span>
                     </a>
                    </li>

                    <!-- Online classes-->
                    <li>
                        <a href="{{route('student.onlineClasses.index')}}">
                            <i class="fa fa-video-camera"></i>
                            <span class="right-nav-text">{{trans('main.Onlineclasses')}}</span>
                        </a>
                    </li>



                    <!-- Exams-->
                    <li>
                        <a href="{{route('student.exams.index')}}">
                            <i class="fa fa-question-circle"></i>
                            <span class="right-nav-text">{{trans('main.Exams')}} </span>
                        </a>
                    </li>


                    <!-- Settings-->
                    <li>
                        <a href="{{route('student.profiles.index')}}">
                            <i class="fa fa-id-card"></i>
                            <span class="right-nav-text">{{trans('main.Student_Profile')}} </span>
                        </a>
                    </li>



                </ul>
            </div>
