@extends('edu_portal.admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Study Materials</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Study Materials</a></li>
                    <li class="breadcrumb-item active">All Study Materials</li>
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
                        <div class="col-md-8">
                            Study Materials
                        </div>
                        <div class="col-md-4 text-right">
                             <span class="d-block fs-16">Select Institution</span>
                             <v-select :options="institutions" label="name" v-model="selected_institution"
                                 :reduce="institutions => institutions.id" @input="get_study_materials"
                                 id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Title</strong></th>
                                    <th><strong>Academic Year</strong></th>
                                    <th><strong>Level</strong></th>
                                    <th><strong>Subject</strong></th>
                                    <th><strong>Teacher</strong></th>
                                    <th><strong>Material Download</strong></th>
                                    <th>Created at</th>
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
                                    <td>@{{ material.teacher.full_name_text }}</td>
                                    <td><a class="text-primary" :href="material.material_path_full_text">Download
                                            Material</a></td>
                                    <td>@{{ material.created_at_text }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger sharp mr-1"
                                            @click="delete_material(material.id)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination :total-items="materials.total" :page="page" :loading="loading_materials"
                        :items-per-page="materials.per_page" v-on:page-change="pageChange">
                    </vue-pagination>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/study-materials.js')}}"></script>
@endsection
