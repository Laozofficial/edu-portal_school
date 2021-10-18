@extends('easy_school.teacher.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Class</h2>
            <p class="mb-0">Classes Assigned To You</p>
        </div>
        <!-- <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z"
                            fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                    <span class="d-block fs-16">Select Institution</span>
                    <v-select :options="institutions" label="name" v-model="selected_institution"
                        :reduce="institutions => institutions.id" @input="get_sessions" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
        </div> -->
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
                                                <button class="btn btn-xs btn-success sharp" v-if="level.id == selected_level">
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

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-classes.js')}}"></script>
@endsection
