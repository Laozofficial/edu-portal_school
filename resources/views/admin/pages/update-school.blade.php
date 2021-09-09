@extends('admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Update School!</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard/admin/index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">@{{institution.name}}</a></li>
            </ol>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
             <div class="card ">
            <div class="card-header">
                <h5>Add Institution</h5>
            </div>
            <div class="card-body">
                  <div v-for="error in errors" class="mb-4 col-md-12 container">
                    <div class="alert alert-danger alert-dismissible fade show" v-show="errors_switch">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <strong>Error!</strong> @{{error}}
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                         <label for="country">Update Institution Country <span class="text-danger">*</span></label>
                         <v-select :options="countries" label="name" v-model="selected_country" :reduce="countries => countries.id" id="country"></v-select>

                         <label for="language" class="mt-3">Update Institution Language <span class="text-danger">*</span></label>
                         <v-select :options="languages" label="name" v-model="selected_language" :reduce="languages => languages.id" id="language"></v-select>

                         <!-- <label for="name" class="mt-3">Update Institution Name <span class="text-danger">*</span></label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Name" id="name" v-model="institution.name"> -->

                         <label for="address" class="mt-3">Update Institution Address <span class="text-danger">*</span></label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Address" id="address" v-model="institution.address">

                          <label for="email" class="mt-3">Update Institution Email <span class="text-danger">*</span></label>
                         <input type="email" class="form-control input-default form-control-sm" placeholder="Email Address" id="email" v-model="institution.email">

                          <label for="phone" class="mt-3">Update Institution Phone Number <span class="text-danger">*</span></label>
                         <input type="number" class="form-control input-default form-control-sm" placeholder="Phone Number" id="phone" v-model="institution.phone">

                         <button class="btn btn-primary btn-sm mt-3 btn-block" @click="update_institution">
                             <i class="fa fa-paper-plane"></i> Submit
                         </button>
                    </div>
                    <div class="col-md-6">
                        <label for="currency">Update Institution Currency <span class="text-danger">*</span></label>
                         <v-select :options="currencies" label="currency_name" v-model="selected_currency" :reduce="currencies => currencies.id" id="currency"></v-select>

                         <label for="states" class="mt-3">Update Institution State Of Origin <span class="text-danger">*</span></label>
                         <v-select :options="states" label="name" v-model="selected_state" :reduce="states => states.id" od="states"></v-select>

                          <label for="prefix" class="mt-3">Update Institution Name Prefix </label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Eg STH" id="prefix" v-model="institution.prefix_code">

                          <label for="website" class="mt-3">Update Institution Website </label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="https://www.something.com" id="website" v-model="institution.website">

                         <!-- <label class="mt-3">Upload Institution Logo <span class="text-danger">*</span></label>
                         <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" @change="onLogoChanged">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div> -->


                        <label class="mt-3">Upload Institution Signature</label>
                         <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" @change="onSignatureChanged">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>

                    </div>
                </div>
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
    <script src="{{asset('admin/plugins/pages/update-school.js')}}"></script>
@endsection
