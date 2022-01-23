  <!-- ========== Left Sidebar Start ========== -->
  <div class="vertical-menu">

      <div data-simplebar class="h-100">

          <!--- Sidemenu -->
          <div id="sidebar-menu">
              <!-- Left Menu Start -->
               <ul class="metismenu" id="menu">
                   <li><a class="" href="{{url('/dashboard/student/index')}}" aria-expanded="false">
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

                   <li><a class="has-arrow ai-icon" href="{{url('/dashboard/student/assignments')}}"
                           aria-expanded="false">
                           <i class="lni lni-direction"></i>
                           <span class="nav-text">Academics</span>
                       </a>
                       <ul aria-expanded="false">
                           <!-- <li><a href="{{url('/dashboard/student/study-materia')}}"><i class="lni lni-users"></i> Classes</a></li> -->
                           <!-- <li><a href="{{url('/dashboard/teacher/traits')}}"><i class="lni lni-more-alt"></i> Traits </a></li>-->
                           <!-- <li><a href="{{url('/dashboard/teacher/grade-scale')}}"><i class="lni lni-network"></i> Grade
                            Scale</a></li> -->
                           <li><a href="{{ url('/dashboard/student/student_assessments') }}" aria-expanded="false">
                                   <i class="lni lni-pencil"></i>
                                   <span class="nav-text">Assessments</span>
                                   <!-- <span class="badge badge-xs badge-danger">New</span> -->
                               </a>
                               <!-- <ul aria-expanded="false">
                            <li><a href="{{url('/dashboard/teacher/assessment-types')}}"><i class="lni lni-list"></i>
                                    Assessment Types</a></li>
                            <li><a href="{{url('/dashboard/teacher/add-assessment')}}"><i class="lni lni-plus"></i> Enter
                                    Assessment Score</a></li>
                        </ul> -->
                           </li>
                           <li><a href="{{url('/dashboard/student/time-table')}}"><i class="lni lni-paperclip"></i> Time
                                   Table</a></li>
                           <li><a href="{{url('/dashboard/student/home-work')}}"><i class="lni lni-paperclip"></i> Home
                                   Works</a></li>
                           <li><a href="{{url('/dashboard/student/submissions')}}"><i class="lni lni-paperclip"></i>
                                   Submissions</a></li>

                       </ul>
                   </li>


                   <li><a class="" href="{{url('/dashboard/student/subject')}}" aria-expanded="false">
                           <i class="lni lni-users"></i>
                           <span class="nav-text">Subjects</span>
                           <!-- <span class="badge badge-xs badge-danger">New</span> -->
                       </a>

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
                   <!-- <li>
                <a href="{{ url('/dashboard/teacher/staff-leave') }}">
                    <i class="lni lni-list"></i>
                    <span class="nav-text">Staff Leave</span>
                </a>
            </li> -->

                   <li>
                       <a href="{{ url('/dashboard/student/profile') }}">
                           <i class="lni lni-list"></i>
                           <span class="nav-text">Profile</span>
                       </a>
                   </li>

                   <li>
                       <a href="{{ url('/dashboard/student/attendance') }}">
                           <i class="lni lni-list"></i>
                           <span class="nav-text">Attendance</span>
                       </a>
                   </li>


                   <li>
                       <a href="{{ url('/dashboard/student/study-materials') }}">
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

              <!-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                            <div class="card-body">
                                <img src="assets/images/giftbox.png" alt="">
                                <div class="mt-4">
                                    <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                                    <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                                    <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    Sidebar -->
          </div>
      </div>
  </div>

  <!-- Left Sidebar End -->
