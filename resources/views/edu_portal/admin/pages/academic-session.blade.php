@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Academic Sessions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academic Session</a></li>
                        <li class="breadcrumb-item active">Add & update Academic Sessions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Add Sessions
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
                            <label for="name">Session Name</label>
                            <input class="datepicker-default form-control form-control-sm" type="text" v-model="name" placeholder="Example 2020/2021">
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="start_year">Session Start Date</label>
                            <input name="datepicker" class="datepicker-default form-control" id="datepicker" type="date" v-model="start_date">
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="start_month">Session End Date</label>
                            <input name="datepicker" class="datepicker-default form-control" id="datepicker" type="date" v-model="end_date">
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
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-block mt-4" @click="save_session">
                                <i class="fa fa-paper-plane"></i> Save Session
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-lg">
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
                                                <th><strong>Session Name</strong></th>
                                                <th><strong>Session Starting</strong></th>
                                                <th><strong>End Date</strong></th>
                                                <th><strong>Status</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(session, index) in sessions">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td>@{{session.name}}</td>
                                                <td><div class="d-flex align-items-center">
                                                    <span class="w-space-no">@{{session.start_date_text}}</span></div>
                                                </td>
                                                <td>@{{session.end_date_text}}	</td>
                                                <td v-if="session.status == 0"><div class="d-flex align-items-center"><i class="fa fa-circle text-success mr-1"></i> @{{session.status_text}}</div> </td>
                                                <td v-if="session.status == 1"><div class="d-flex align-items-center"> <i class="fa fa-circle text-danger mr-1"></i> @{{session.status_text}}</div> </td>
                                                 <td>
													<div class="d-flex">
														<a @click="update_session(session.id)" class="btn btn-success btn-sm shadow btn-xs sharp mr-1"><i class="fa fa-pen text-white"></i></a>
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
            </div>
        </div>
     </div>


     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="update_session">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Session</h5>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <label for="name">Session Name</label>
                        <input class="datepicker-default form-control form-control-sm" type="text" v-model="session.name" placeholder="Example 2020/2021">
                    </div>
                    <div class="col-lg-12 mt-4">
                        <label for="start_year">Session Start Date</label>
                        <input class="datepicker-default form-control" id="datepicker" type="date" v-model="session.start_date">
                    </div>
                    <div class="col-lg-12 mt-4">
                        <label for="start_month">Session End Date</label>
                        <input class="datepicker-default form-control" id="datepicker" type="date" v-model="session.end_date">
                    </div>
                        <div class="col-lg-12 mt-4">
                        <label for="start_month">Session Status</label>
                        <div class="form-group">
                            <select class="form-control default-select form-control-lg" v-model="session.status">
                                <option value="0">Active</option>
                                <option value="1">Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save_update_session(session.id)">Update changes</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
     <script src="{{asset('easy_school/admin/plugins/pages/academic-session.js')}}"></script>
@endsection
