@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Students In A Class</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academic</a></li>
                        <li class="breadcrumb-item active">Classes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="cal-md-6">
                            Students
                        </div>
                        <div class="col-md-6 text-right">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Student Name</strong></th>
                                    <th><strong>Class</strong></th>
                                    <th><strong>Teacher</strong></th>
                                    <th><strong>Gender</strong></th>
                                    <th><strong>created at</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student, index) in students">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>@{{student.full_name_text}}</td>
                                    <td v-if="student.level.status == 0">@{{student.level.name}}</td>
                                    <td v-if="student.level.status == 1">@{{student.level.name}}</td>
                                    <td>@{{student.level.teacher.full_name_text}}</td>
                                    <td>@{{ student.gender }}</td>
                                    <td>@{{student.level.created_at_text}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-sm sharp mr-1" @click="student_details(student.id)"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
     </div>


@endsection
@section('script')
    <script>
        let id = "{{ $id }}"
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/see-class-students.js')}}"></script>
@endsection
