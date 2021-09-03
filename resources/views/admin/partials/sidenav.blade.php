<!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="" href="{{url('/dashboard/index')}}" aria-expanded="false">
                            <i class="lni lni-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="{{url('/dashboard/school')}}" aria-expanded="false">
                            <i class="lni lni-school-bench-alt"></i>
                            <span class="nav-text">School</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/add-school')}}"><i class="lni lni-plus"></i> Add School</a></li>
                            <li><a href="{{url('/dashboard/all-schools')}}"><i class="lni lni-list"></i> All Schools</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="" aria-expanded="false">
                            <i class="lni lni-direction"></i>
                            <span class="nav-text">Academic</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/academic-session')}}"><i class="lni lni-school-bench-alt"></i> Academic Session</a></li>
                            <li><a href="{{url('/dashboard/subjects')}}"><i class="lni lni-book"></i> Subjects</a></li>
                            <li><a href="{{url('/dashboard/classes')}}"><i class="lni lni-users"></i> Classes</a></li>
                            <li><a href="{{url('/dashboard/traits')}}"><i class="lni lni-more-alt"></i> Traits </a></li>
                            <li><a href="{{url('/dashboard/grade-scale')}}"><i class="lni lni-network"></i> Grade Scale</a></li>
                             <li><a class="has-arrow ai-icon" aria-expanded="false">
                                    <i class="lni lni-pencil"></i>
                                    <span class="nav-text">Assessments</span>
                                    <!-- <span class="badge badge-xs badge-danger">New</span> -->
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="{{url('/dashboard/assessment-types')}}"><i class="lni lni-list"></i> Assessment Types</a></li>
                                    <li><a href="{{url('/dashboard/add-assessment')}}"><i class="lni lni-plus"></i> Enter Assessment Score</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/dashboard/time-table')}}"><i class="lni lni-paperclip"></i> Time Table</a></li>
                            <li><a href="{{url('/dashboard/assignment')}}"><i class="lni lni-customer"></i> Assignments</a></li>
                        </ul>
                    </li>


                     <li><a class="has-arrow ai-icon" href="" aria-expanded="false">
                            <i class="lni lni-users"></i>
                            <span class="nav-text">Students</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/students')}}"><i class="lni lni-user"></i> Students</a></li>
                            <li><a href="{{url('/dashboard/add-students')}}"><i class="lni lni-plus"></i> Add Students</a></li>
                            <li><a href="{{url('/dashboard/student-attendance')}}"><i class="lni lni-checkmark-circle"></i> Mark Attendance</a></li>
                            <li><a href="{{url('/dashboard/student-remark')}}"><i class="lni lni-cup"></i> Remark</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="" aria-expanded="false">
                            <i class="lni lni-users"></i>
                            <span class="nav-text">Teachers</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/teachers')}}"><i class="lni lni-user"></i> Teachers</a></li>
                            <li><a href="{{url('/dashboard/add-teacher')}}"><i class="lni lni-plus"></i> Add Teachers</a></li>
                        </ul>
                    </li>


                    <li><a class="has-arrow ai-icon" href="" aria-expanded="false">
                            <i class="lni lni-users"></i>
                            <span class="nav-text">Parents</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/parents')}}"><i class="lni lni-user"></i> Parents</a></li>
                            <li><a href="{{url('/dashboard/add-parents')}}"><i class="lni lni-plus"></i> Add Parents</a></li>
                        </ul>
                    </li>


                    <li><a href="{{url('/dashboard/subscriptions')}}">
                            <i class="lni lni-bolt"></i>
                            <span class="nav-text">Subscriptions</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
                        </a>
                    </li>


                    <li><a href="{{url('/dashboard/notifications')}}">
                            <i class="fa fa-bell"></i>
                            <span class="nav-text">Notifications</span>
                            <!-- <span class="badge badge-xs badge-danger">New</span> -->
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
