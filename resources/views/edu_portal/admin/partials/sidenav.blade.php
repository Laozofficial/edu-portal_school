  <!-- ========== Left Sidebar Start ========== -->
  <div class="vertical-menu">

      <div data-simplebar class="h-100">

          <!--- Sidemenu -->
          <div id="sidebar-menu">
              <!-- Left Menu Start -->
              <ul class="metismenu list-unstyled" id="side-menu">
                  <li class="menu-title" data-key="t-menu">Menu</li>

                  <li>
                      <a href="{{url('dashboard/admin/index')}}">
                          <i class="lni lni-home lni-16"></i>
                          <span data-key="t-dashboard">Dashboard</span>
                      </a>
                  </li>

                  <li>
                      <a href="javascript: void(0);" class="has-arrow">
                          <i class="lni lni-school-bench-alt"></i>
                          <span data-key="t-apps">School</span>
                      </a>
                      <ul class="sub-menu" aria-expanded="false">
                          <li>
                              <a href="{{url('/dashboard/admin/add-school')}}">
                                  <i class="lni lni-plus lni-sm"></i>Add School
                              </a>
                          </li>
                          <li>
                              <a href="{{url('/dashboard/admin/all-schools')}}">
                                  <i class="lni lni-list lni-sm"></i> All Schools
                              </a>
                          </li>
                      </ul>
                  </li>


                  <li>
                      <a href="javascript: void(0);" class="has-arrow">
                          <i class="lni lni-direction"></i>
                          <span data-key="t-apps">Academics</span>
                      </a>
                      <ul class="sub-menu" aria-expanded="false">
                          <li><a href="{{url('/dashboard/admin/academic-session')}}"><i
                                      class="lni lni-school-bench-alt"></i> Academic Session</a></li>
                          <li><a href="{{url('/dashboard/admin/term')}}"><i class="lni lni-blackboard"></i> Terms</a>
                          </li>
                          <li><a href="{{url('/dashboard/admin/subjects')}}"><i class="lni lni-book"></i> Subjects</a>
                          </li>
                          <li><a href="{{url('/dashboard/admin/classes')}}"><i class="lni lni-users"></i> Classes</a>
                          </li>
                          <li><a href="{{url('/dashboard/admin/grade-scale')}}"><i class="lni lni-network"></i> Grade
                                  Scale</a></li>
                          <li><a class="has-arrow ai-icon" aria-expanded="false">
                                  <i class="lni lni-pencil"></i>
                                  <span class="nav-text">Assessments</span>
                                  <!-- <span class="badge badge-xs badge-danger">New</span> -->
                              </a>
                              <ul aria-expanded="false">
                                  <li><a href="{{url('/dashboard/admin/assessment-types')}}"><i
                                              class="lni lni-list"></i> Assessment Types</a></li>
                                  <li><a href="{{url('/dashboard/admin/add-assessment')}}"><i class="lni lni-plus"></i>
                                          Enter Assessment Score</a></li>
                              </ul>
                          </li>
                          <li><a href="{{url('/dashboard/admin/time-table')}}"><i class="lni lni-paperclip"></i> Time
                                  Table</a></li>
                      </ul>
                  </li>

                  <li><a class="has-arrow ai-icon" href="javascript: void(0);" aria-expanded="false">
                          <i class="lni lni-users"></i>
                          <span class="nav-text">Students</span>
                          <!-- <span class="badge badge-xs badge-danger">New</span> -->
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="{{url('/dashboard/admin/students')}}"><i class="lni lni-user"></i> Students</a>
                          </li>
                          <li><a href="{{url('/dashboard/admin/add-students')}}"><i class="lni lni-plus"></i> Add
                                  Students</a></li>
                            <li><a href="{{url('/dashboard/admin/alumni')}}"><i class="lni lni-user"></i> Alumni's</a></li>
                         <!-- <li><a href="{{url('/dashboard/admin/student-attendance')}}"><i
                                      class="lni lni-checkmark-circle"></i> Mark Attendance</a></li>
                          <li><a href="{{url('/dashboard/admin/student-remark')}}"><i class="lni lni-cup"></i>
                                  Remark</a></li>-->
                      </ul>
                  </li>

                  <li><a class="has-arrow ai-icon" href="javascript: void(0);" aria-expanded="false">
                          <i class="lni lni-users"></i>
                          <span class="nav-text">Teachers</span>
                          <!-- <span class="badge badge-xs badge-danger">New</span> -->
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="{{url('/dashboard/admin/teachers')}}"><i class="lni lni-user"></i> Teachers</a>
                          </li>
                          <li><a href="{{url('/dashboard/admin/add-teacher')}}"><i class="lni lni-plus"></i> Add
                                  Teachers</a></li>
                      </ul>
                  </li>


                  <!-- <li><a class="has-arrow ai-icon" href="javascript: void(0);" aria-expanded="false">
                          <i class="lni lni-users"></i>
                          <span class="nav-text">Parents</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="{{url('/dashboard/admin/parents')}}"><i class="lni lni-user"></i> Parents</a>
                          </li>

                      </ul>
                  </li> -->


                  <li><a href="{{url('/dashboard/admin/subscriptions')}}">
                          <i class="lni lni-bolt"></i>
                          <span class="nav-text">Subscriptions</span>
                          <!-- <span class="badge badge-xs badge-danger">New</span> -->
                      </a>
                  </li>


                  <li><a href="{{url('/dashboard/admin/notifications')}}">
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
