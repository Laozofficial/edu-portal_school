@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Classes</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a></li>
                    <li class="breadcrumb-item active">Classes</li>
                </ol>
            </div>
        </div>
    </div>
</div>


   <div class="row">
       <div class="col-md-12">
           <div class="row">
               <div class="col-md-5">
                   <div class="card shadow-lg">
                       <div class="card-header">
                           Classes assigned to you
                       </div>
                       <div class="card-body">
                           <div class="table-responsive">
                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">Class Code</th>
                                           <th scope="col">Class Name</th>
                                           <th scope="col"></th>
                                           <th scope="col"></th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr v-for="(level, index) in classes">
                                           <td>@{{ index + 1 }}</td>
                                           <td>@{{ level.code }}</td>
                                           <td>@{{ level.name }}</td>
                                           <td>
                                               <button class="btn btn-primary btn-xs" @click="fetch_students(level.id)">
                                                   <i class="fa fa-eye"></i> Enrolled Students
                                               </button>
                                           </td>
                                           <td>
                                               <button class="btn btn-xs btn-success sharp"
                                                   v-if="level.id == selected_level">
                                                   <i class="fa fa-check"></i>
                                               </button>
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-md-7">
                   <div class="card">
                       <div class="card-header">
                           Enrolled Student
                       </div>
                       <div class="card-body">
                           <div class="table-responsive">
                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">Student Name</th>
                                           <th scope="col">Admission Number</th>
                                           <th scope="col">Gender</th>
                                           <th scope="col">Date of Birth</th>
                                           <!--<th scope="col"></th>-->
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr v-for="(student, index) in students.data">
                                           <td>@{{ index + 1 }}</td>
                                           <td>@{{ student.full_name_text }}</td>
                                           <td>@{{ student.admission_number }}</td>
                                           <td>@{{ student.gender }}</td>
                                           <td>@{{ student.date_of_birth }}</td>
                                           <!--<td>
                                                <button class="btn btn-primary btn-xs" @click="view_student(student.id)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>-->

                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                       <div class="card-footer">
                           <vue-pagination :total-items="students.total" :page="page" :loading="loading_students"
                               :items-per-page="students.per_page" v-on:page-change="pageChange">
                           </vue-pagination>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>


@endsection
@section('script')
   <script src="{{asset('easy_school/admin/plugins/pages/teacher-classes.js')}}"></script>
@endsection
