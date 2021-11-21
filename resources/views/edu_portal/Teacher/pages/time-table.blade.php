@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Time Table</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Time Table</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
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
                      <div class="col-md-6">
                           Time Tables
                      </div>
                      <!-- <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution"
                                :reduce="institutions => institutions.id" @input="get_other_details" id="institution">
                            </v-select>
                      </div> -->
                  </div>
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-md-4">
                           <label class="text-left mt-2 mb-4">Filter By Academic Session</label>
                           <v-select :options="sessions" label="name" v-model="filter_selected_session"
                               :reduce="sessions => sessions.id" id="sessions" @input="filter_time_table">
                           </v-select>
                       </div>
                       <div class="col-md-4">
                           <label class="text-left mt-2 mb-4">Filter By Class</label>
                           <v-select :options="levels" label="name" v-model="filter_selected_level"
                               :reduce="levels => levels.id" id="levels" @input="filter_time_table"></v-select>
                       </div>
                       <div class="col-md-4">
                           <label class="stext-left mt-2 mb-4">Filter By Term</label>
                           <v-select :options="terms" label="name" v-model="filter_selected_term"
                               :reduce="terms => terms.id" id="levels" @input="filter_time_table"></v-select>
                       </div>


                   </div>

                   <div class="table-responsive">
                       <table class="table table-responsive-md">
                           <thead>
                               <tr>
                                   <th style="width:80px;"><strong>#</strong></th>
                                   <th><strong>Session</strong></th>
                                   <th><strong>Class</strong></th>
                                   <th><strong>Term</strong></th>
                                   <th><strong>Download</strong></th>
                                   <!-- <th></th> -->
                               </tr>
                           </thead>
                           <tbody>
                               <tr v-for="(time_table, index) in time_tables">
                                   <td>@{{ index + 1 }}</td>
                                   <td>@{{ time_table.academic_year.name }}</td>
                                   <td>@{{ time_table.level.name }}</td>
                                   <td>@{{ time_table.term.name }}</td>
                                   <td><a :href="time_table.download_link" class="text-primary"> Download</a></td>
                                   <!-- <td>
                                           <div class="d-flex">
                                               <a href="#" class="btn btn-danger shadow btn-xs sharp mr-1"
                                                   @click="delete_time_table(time_table.id)"><i
                                                       class="fa fa-trash text-white"></i></a>
                                           </div>
                                       </td> -->
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-time-table.js')}}"></script>
@endsection
