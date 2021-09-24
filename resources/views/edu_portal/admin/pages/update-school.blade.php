@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Update School</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Update School</a></li>
                        <li class="breadcrumb-item active">@{{institution.name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


     <div class="row">
        <div class="col-lg-12">
             <div class="card shadow-lg">
            <div class="card-header">
                Add Institution
            </div>
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" v-show="errors_switch">
                    <div  v-for="error in errors">
                        @{{ error  }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                         <!-- <label for="country">Update Institution Country <span class="text-danger">*</span></label>
                         <v-select :options="countries" label="name" v-model="selected_country" :reduce="countries => countries.id" id="country"></v-select> -->

                         <label for="language" class="">Update Institution Language <span class="text-danger">*</span></label>
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

                         <!-- <label for="states" class="mt-3">Update Institution State Of Origin <span class="text-danger">*</span></label>
                         <v-select :options="states" label="name" v-model="selected_state" :reduce="states => states.id" od="states"></v-select> -->

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


@endsection
@section('script')
    <script>
        let id = "{{$id}}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/update-school.js')}}"></script>
@endsection
