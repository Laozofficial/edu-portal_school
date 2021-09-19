@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="form-head d-flex mb-3 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h2 class="text-black font-w600 mb-0">Academic Session</h2>
                <p class="mb-0">Add An Academic Session</p>
            </div>
            <div class="dropdown custom-dropdown">
                <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD"></path>
                        </g>
                    </svg>
                    <div class="text-left ml-3">
                        <span class="d-block fs-16">Select Institution</span>
                        <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_sessions" id="institution"></v-select>
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Session</h4>
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
														<a @click="update_session(session.id)" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-pencil text-white"></i></a>
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
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
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
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save_update_session(session.id)">Update changes</button>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/academic-session.js')}}"></script>
@endsection
