@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Terms</h2>
            <p class="mb-0">Add A Term</p>
        </div>
        <div class="dropdown custom-dropdown">
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
                        :reduce="institutions => institutions.id" @input="get_study_materials" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
            <!-- <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">4 June 2020 - 4 July 2020</a>
                <a class="dropdown-item" href="#">5 july 2020 - 4 Aug 2020</a>
            </div> -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
               <div class="card-header">
                    Study Materials
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
                                  <td><a class="text-primary" :href="material.material_path_full_text">Download Material</a></td>
                                  <td>@{{ material.created_at_text }}</td>
                                  <td>
                                      <button class="btn btn-xs btn-danger sharp mr-1" @click="delete_material(material.id)">
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

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/study-materials.js')}}"></script>
@endsection
