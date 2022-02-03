@extends('edu_portal.student.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Time Table</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Time Table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

 <div class="row">
     <div class="col-md-12">
         <div class="card shadow-lg">
             <div class="card-header">
                 Time Table of Your Current Class
             </div>
             <div class="card-body">
                 <table class="table table-sm">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">Academic Year</th>
                             <th scope="col">Term</th>
                             <th scope="col">Class</th>
                             <th scope="col">Download Time Table</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr v-for="(tt, index) in time_table">
                             <th scope="row">@{{ index + 1 }}</th>
                             <td>@{{ tt.academic_year.name }}</td>
                             <td>@{{ tt.term.name }}</td>
                             <td>@{{ tt.level.name }}</td>
                             <td>
                                 <a :href="tt.download_link" class="text-primary">
                                     Download Time Table
                                 </a>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/student_time_table.js')}}"></script>
@endsection
