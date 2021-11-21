@extends('edu_portal.teacher.layouts.app')

@section('content')

@section('style')
<link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Study Material</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Create and Update Study materials</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>


 <div class="row">
     <div class="col-md-4">
         <div class="card shadow-lg">
             <div class="card-header">Add Study Materials</div>
             <div class="card-body">
                 <label class="text-left mt-2 mb-4">Academic Session</label>
                 <v-select :options="sessions" label="name" v-model="selected_session" :reduce="sessions => sessions.id"
                     id="sessions">
                 </v-select>

                 <label class="text-left mt-2 mt-3">Select Class</label>
                 <v-select :options="levels" label="name" v-model="selected_level" @input="get_subjects"
                     :reduce="levels => levels.id" id="level">
                 </v-select>

                 <label class="text-left mt-2 mt-3">Select Subject</label>
                 <v-select :options="subjects" label="name" v-model="selected_subject" :reduce="subjects => subjects.id"
                     id="subjects">
                 </v-select>

                 <label class="mt-3">Material Title</label>
                 <input class="form-control form-control-sm" type="text" v-model="title" />

                 <label class="mt-3">Upload Material</label>
                 <input class="form-control form-control-sm" type="file" @change="onMaterialChange" />

                 <label for="" class="mt-3">Description</label>
                 <textarea class="summernote"></textarea>

                 <button class="btn btn-primary btn-block btn-sm mt-3" @click="save_material">
                     <i class="fa fa-paper-plane"></i> Add Study Material
                 </button>
             </div>
         </div>
     </div>
     <div class="col-md-8">
         <div class="card shadow-lg">
             <div class="card-header">Your Materials</div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table">
                         <table class="table table-sm">
                             <thead>
                                 <tr>
                                     <th style="width:80px;"><strong>#</strong></th>
                                     <th><strong>Title</strong></th>
                                     <th><strong>Session</strong></th>
                                     <th><strong>Class</strong></th>
                                     <th><strong>Subject</strong></th>
                                     <th><strong>Download</strong></th>
                                     <th><strong>Created At</strong></th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(material, index) in materials.data">
                                     <td>@{{ index + 1 }}</td>
                                     <td>@{{ material.title }}</td>
                                     <td>@{{ material.academic_year.name }}</td>
                                     <td>@{{ material.level.name }}</td>
                                     <td>@{{ material.subject.name }}</td>
                                     <td><a :href="material.material_path_full_text" class="text-primary"> Download
                                             Material</a></td>
                                     <td>@{{ material.created_at_text }}</td>
                                     <td>
                                         <div class="d-flex">
                                             <a href="#" class="btn btn-danger shadow btn-xs sharp mr-1"
                                                 @click="delete_material(material.id)"><i
                                                     class="fa fa-trash text-white"></i></a>
                                         </div>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </table>
                 </div>
             </div>
         </div>
         <div class="card-footer">
             <vue-pagination :total-items="materials.total" :page="page" :loading="loading_materials"
                 :items-per-page="materials.per_page" v-on:page-change="pageChange">
             </vue-pagination>
         </div>
     </div>
 </div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>

<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{ asset('easy_school/admin/plugins/pages/teacher-study-material.js')}}"></script>
@endsection
