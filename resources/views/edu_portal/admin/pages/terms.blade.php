@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Terms </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Terms</a></li>
                        <li class="breadcrumb-item active">View Terms</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Add Terms
                        </div>
                        <div class="col-md-8 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_sessions" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="academic_year">Academic Session</label>
                            <v-select :options="sessions" label="name" v-model="selected_session" :reduce="session => session.id" id="academic_year"></v-select>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="name">Term Name</label>
                            <input class="form-control form-control-sm" type="text" v-model="name" placeholder="Eg First Term"/>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="name">Term Start Date</label>
                            <input class="form-control form-control-sm" type="date" v-model="start_date" placeholder="Start Date"/>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="name">Term End Date</label>
                            <input class="form-control form-control-sm" type="date" v-model="end_date" placeholder="End Date"/>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="start_month">Session Status</label>
                            <div class="form-group">
                                <select class="form-control default-select form-control-lg" v-model="status">
                                    <option value="0">Active</option>
                                    <option value="1">Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button class="btn btn-primary btn-sm btn-block" @click="save_term">
                                <i class="fa fa-paper-plane"></i> Save Term
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
             <div class="card">
                <div class="card-header">
                    <h4>Sessions</h4>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="cad">
                            <div class="card-ody">
                               <div class="table table-sm">
                                    <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>S/N</strong></th>
                                                <th><strong>Session</strong></th>
                                                <th><strong>Term</strong></th>
                                                <th><strong>Term Starting</strong></th>
                                                <th><strong>Term End Date</strong></th>
                                                <th><strong>Status</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(term, index) in terms.data">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td>@{{term.academic_year.name}}</td>
                                                <td><div class="d-flex align-items-center">
                                                    <span class="w-space-no">@{{term.name}}</span></div>
                                                </td>
                                                <td>@{{term.start_date_text}}	</td>
                                                <td>@{{term.end_date_text}}	</td>
                                                <td v-if="term.status == 0"><div class="d-flex align-items-center"><i class="fa fa-circle text-success mr-1"></i> @{{term.status_text}}</div> </td>
                                                <td v-if="term.status == 1"><div class="d-flex align-items-center"> <i class="fa fa-circle text-danger mr-1"></i> @{{term.status_text}}</div> </td>
                                                 <td>
													<div class="d-flex">
														<a @click="update_term(term.id)" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-pen text-white"></i></a>
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
                </div>
                <div class="card-footer">
                    <vue-pagination
                        :total-items="terms.total"
                        :page="page"
                        :loading="loading_terms"
                        :items-per-page="terms.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>


      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="update_term">
        <div class="modal-dialog model-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Term</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-lg-12 mt-4">
                                <label for="start_year">Term Name</label>
                                <input class="datepicker-default form-control" id="datepicker" type="text" v-model="term.name">
                            </div>

                           <div class="col-lg-12 mt-4">
                                <label for="start_month">Term End Date</label>
                                <input class="datepicker-default form-control" id="datepicker" type="date" v-model="term.end_date">
                            </div>
                        </div>
                        <div class="col-md-6">

                             <div class="col-lg-12 mt-4">
                                <label for="start_year">Term Start Date</label>
                                <input class="datepicker-default form-control" id="datepicker" type="date" v-model="term.start_date">
                            </div>

                             <div class="col-lg-12 mt-4">
                                <label for="start_month">Term Status</label>
                                <div class="form-group">
                                    <select class="form-control default-select form-control-lg" v-model="term.status">
                                        <option value="0">Active</option>
                                        <option value="1">Not Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save_update_term(term.id)">Update changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/terms.js')}}"></script>
@endsection
