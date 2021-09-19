@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>@{{institution.name}}</h4>
                <!-- <p class="mb-0">Your business dashboard template</p> -->
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">@{{institution.name}}</a></li>
            </ol>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <!-- <div class="cover-photo" style="background: url({{asset('admin/images/easyschool_logo.png')}});"></div> -->
                                </div>
                                <div class="profile-info">
									<div class="profile-photo">
										<img :src="institution.full_logo_path" class="img-fluid rounded-circle" alt="">
									</div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
											<h4 class="text-primary mb-0">@{{institution.name}}</h4>
											<p>@{{institution.address + ', '+ institution.state.name + ', '+ institution.country.name}} State</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0">@{{institution.email}}</h4>
										</div>
										<div class="dropdown ml-auto">
											<a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item" @click="update(institution.slug)"><i class="fa fa-pencil text-primary mr-2"></i> Update</li>
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Data</h2>
                </div>
            </div>
        </div>
     </div>

</div>

@endsection
@section('script')
    <script>
        let id = "{{$id}}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/school_details.js')}}"></script>
@endsection
