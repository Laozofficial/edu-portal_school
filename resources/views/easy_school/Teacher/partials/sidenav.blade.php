<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="" href="{{url('/dashboard/teacher/index')}}" aria-expanded="false">
                    <i class="lni lni-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <!--<li><a class="has-arrow ai-icon" href="{{url('/dashboard/teacher/school')}}" aria-expanded="false">
                    <i class="lni lni-school-bench-alt"></i>
                    <span class="nav-text">School</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('/dashboard/teacher/add-school')}}"><i class="lni lni-plus"></i> Add School</a>
                    </li>
                    <li><a href="{{url('/dashboard/teacher/all-schools')}}"><i class="lni lni-list"></i> All Schools</a>
                    </li>
                </ul>
            </li>-->

            <li><a class="has-arrow ai-icon" href="{{url('/dashboard/teacher/academic')}}" aria-expanded="false">
                    <i class="lni lni-direction"></i>
                    <span class="nav-text">Academic</span>
                    <!-- <span class="badge badge-xs badge-danger">New</span> -->
                </a>
                <ul aria-expanded="false">
                    <!--<li><a href="{{url('/dashboard/teacher/academic-session')}}"><i class="lni lni-school-bench-alt"></i>
                            Academic Session</a></li>
                    <li><a href="{{url('/dashboard/teacher/term')}}"><i class="lni lni-blackboard"></i> Terms</a></li>
                    <li><a href="{{url('/dashboard/teacher/subjects')}}"><i class="lni lni-book"></i> Subjects</a></li>
                    -->
                    <li><a href="{{url('/dashboard/teacher/classes')}}"><i class="lni lni-users"></i> Classes</a></li>
                   <!-- <li><a href="{{url('/dashboard/teacher/traits')}}"><i class="lni lni-more-alt"></i> Traits </a></li>-->
                    <li><a href="{{url('/dashboard/teacher/grade-scale')}}"><i class="lni lni-network"></i> Grade
                            Scale</a></li>
                    <li><a class="has-arrow ai-icon" aria-expanded="false">
                            <i class="lni lni-pencil"></i>
                            <span class="nav-text">Assessments</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <!--<li><a href="{{url('/dashboard/teacher/assessment-types')}}"><i class="lni lni-list"></i>
                                    Assessment Types</a></li>-->
                            <li><a href="{{url('/dashboard/teacher/add-assessment')}}"><i class="lni lni-plus"></i> Enter
                                    Assessment Score</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/dashboard/teacher/time-table')}}"><i class="lni lni-paperclip"></i> Time
                            Table</a></li>
                    <li><a href="{{url('/dashboard/teacher/assignment')}}"><i class="lni lni-customer"></i>
                            Assignments</a></li>
                </ul>
            </li>


            <li><a class="has-arrow ai-icon" href="{{url('/dashboard/teacher/student')}}" aria-expanded="false">
                    <i class="lni lni-users"></i>
                    <span class="nav-text">Students</span>
                    <!-- <span class="badge badge-xs badge-danger">New</span> -->
                </a>
                <ul aria-expanded="false">
                   <li><a href="{{url('/dashboard/teacher/students')}}"><i class="lni lni-user"></i> Students</a></li>
                     <!--<li><a href="{{url('/dashboard/teacher/add-students')}}"><i class="lni lni-plus"></i> Add Students</a>
                    </li>-->
                    <li><a href="{{url('/dashboard/teacher/student-attendance')}}"><i
                                class="lni lni-checkmark-circle"></i> Mark Attendance</a></li>
                    <li><a href="{{url('/dashboard/teacher/student-remark')}}"><i class="lni lni-cup"></i> Remark</a></li>
                </ul>
            </li>

             <!--  <li><a class="has-arrow ai-icon" href="{{url('/dashboard/teacher/teachers')}}" aria-expanded="false">
                    <i class="lni lni-users"></i>
                    <span class="nav-text">Teachers</span>
                  <span class="badge badge-xs badge-danger">New</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('/dashboard/teacher/teachers')}}"><i class="lni lni-user"></i> Teachers</a></li>
                    <li><a href="{{url('/dashboard/teacher/add-teacher')}}"><i class="lni lni-plus"></i> Add Teachers</a>
                    </li>
                </ul>
            </li>-->


            <!-- <li><a class="has-arrow ai-icon" href="{{url('/dashboard/teacher/parents')}}" aria-expanded="false">
                            <i class="lni lni-users"></i>
                            <span class="nav-text">Parents</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/teacher/parents')}}"><i class="lni lni-user"></i> Parents</a></li>
                        </ul>
                    </li> -->


            <li>
                <a href="{{ url('/dashboard/teacher/study-materials') }}">
                    <i class="lni lni-book"></i>
                    <span class="nav-text">Study Materials</span>
                </a>
            </li>

            <li><a href="#">
                    <i class="lni lni-laptop-phone"></i>
                    <span class="nav-text">CBT</span>
                    <span class="badge badge-xs badge-primary">Coming Soon</span>
                </a>
            </li>


        </ul>

        <div class="copyright mt-3">
            <p><strong>Easy School</strong> © 2021 All Rights Reserved</p>
            <p>Made with <span class="heart"></span> by EasyAce Synergy</p>
        </div>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
