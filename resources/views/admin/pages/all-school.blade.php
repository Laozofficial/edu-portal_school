@extends('admin.layouts.app')



@section('content')

<div class="text-center justify-content-center align-content-center mt-lg-5" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-4x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Entered Schools!</h4>
                <!-- <p class="mb-0">Your business dashboard template</p> -->
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Schools</a></li>
            </ol>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Schools</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>S/N</strong></th>
                                                <th><strong>NAME</strong></th>
                                                <th><strong>Email</strong></th>
                                                <th><strong>Date</strong></th>
                                                <th><strong>Status</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(institution, index) in institutions">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td><div class="d-flex align-items-center"><img :src="institution.full_logo_path" class="rounded-lg mr-2" width="24" alt=""/> <span class="w-space-no">@{{institution.name}}</span></div></td>
                                                <td>@{{institution.email}}</td>
                                                <td>@{{institution.created_at_text}}</td>
                                                <td><div class="d-flex align-items-center"><i class="fa fa-circle text-success mr-1"></i> @{{institution.subscription.status_text}}</div></td>
                                                <td>
													<div class="d-flex">
														<a @click="view(institution.slug)" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-eye text-white"></i></a>
													</div>
												</td>
                                                <td>
													<div class="d-flex">
														<a @click="update(institution.slug)" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil text-white"></i></a>
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

@endsection
@section('script')
    <script src="{{asset('admin/plugins/pages/all-schools.js')}}"></script>
@endsection
