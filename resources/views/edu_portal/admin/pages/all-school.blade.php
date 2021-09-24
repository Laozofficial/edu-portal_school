@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Schools</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">School</a></li>
                        <li class="breadcrumb-item active">All Schools</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
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
                                    <th></th>
                                    <th></th>
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
                                            <a @click="view(institution.slug)" class="btn btn-success btn-sm shadow btn-xs sharp mr-1"><i class="fa fa-eye text-white"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a @click="update(institution.slug)" class="btn btn-primary btn-sm shadow btn-xs sharp mr-1"><i class="fa fa-pen text-white"></i></a>
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
      <script src="{{asset('easy_school/admin/plugins/pages/all-schools.js')}}"></script>
@endsection
