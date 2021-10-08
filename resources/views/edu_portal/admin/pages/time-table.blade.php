@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Time Table</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academics </a></li>
                        <li class="breadcrumb-item active">Time Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


      <div class="row text-cente">
         <div class="col-md-4">
                <div class="text-cente">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                Upload Time Table
                            </div>
                            <div class="col-md-8 text-right">
                                 <span class="d-block fs-16">Select Institution</span>
                                 <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_other_details" id="institution"></v-select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" v-show="errors_switch">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                               <div v-for="error in errors">
                                        <strong>Error!</strong> @{{ error  }}
                                </div>
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button>
                        </div>

                        <label class="text-left mt-2">Select Academic Session</label>
                        <v-select :options="sessions" label="name" v-model="selected_session" :reduce="sessions => sessions.id" id="sessions" @input="get_terms"></v-select>

                        <label class="text-left mt-4">Select Class</label>
                        <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id" id="levels"></v-select>

                        <label class="stext-left mt-4">Select Term</label>
                        <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id" id="levels"></v-select>

                        <label class="mt-4">Upload Time Table</label>
                        <input class="form-control form-control-sm" type="file" @change="onTimeTableChange"/>

                        <button class="btn btn-primary btn-sm btn-block mt-3" @click="save_time_table">
                            <i class="fa fa-paper-plane"></i> Add Time Table
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    Time Tables
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="text-left mt-2 mb-4">Filter By Academic Session</label>
                            <v-select :options="sessions" label="name" v-model="filter_selected_session" :reduce="sessions => sessions.id" id="sessions" @input="filter_time_table"></v-select>
                        </div>
                        <div class="col-md-4">
                            <label class="text-left mt-2 mb-4">Filter By Class</label>
                            <v-select :options="levels" label="name" v-model="filter_selected_level" :reduce="levels => levels.id" id="levels" @input="filter_time_table"></v-select>
                        </div>
                        <div class="col-md-4">
                            <label class="stext-left mt-2 mb-4">Filter By Term</label>
                            <v-select :options="terms" label="name" v-model="filter_selected_term" :reduce="terms => terms.id" id="levels" @input="filter_time_table"></v-select>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(time_table, index) in time_tables">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ time_table.academic_year.name }}</td>
                                    <td>@{{ time_table.level.name }}</td>
                                    <td>@{{ time_table.term.name }}</td>
                                    <td><a :href="time_table.download_link" class="text-primary"> Download</a></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-danger shadow btn-sm sharp mr-1" @click="delete_time_table(time_table.id)"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
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
<script src="{{asset('easy_school/admin/plugins/pages/time-table.js')}}"></script>
@endsection
