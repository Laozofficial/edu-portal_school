@extends('edu_portal.admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add School</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leave Type Settings</a></li>
                    <li class="breadcrumb-item active">Leave Type</li>
                </ol>
            </div>
        </div>
    </div>
</div>

   <div class="row">
       <div class="col-md-6">
           <div class="card shadow-lg">
               <div class="card-header">
                   <div class="row">
                       <div class="col-md-6">
                           Add Leave Type
                       </div>
                       <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution"
                                :reduce="institutions => institutions.id" @input="get_leave_types" id="institution">
                            </v-select>
                       </div>
                   </div>
               </div>
               <div class="card-body">
                   <label class="mt-3">Leave Type Name</label>
                   <input class="form-control form-controol-sm mb-3" type="text" v-model="name" />

                   <label>Leave Days | <small id="emailHelp" class="form-text text-muted mb-3">Calculated in days.</small></label>
                   <input class="form-control form-control-sm mb-3" type="number" v-model="total_days"
                       id="exampleInputEmail1" aria-describedby="emailHelp" />

                    <br><br>
                   <button class="btn btn-sm btn-block btn-primary" @click="save_leave_type">
                       <i class="fa fa-paper-plane"></i> Add Leave Type
                   </button>
               </div>
           </div>
       </div>
       <div class="col-md-6">
           <div class="card shadow-lg">
               <div class="card-header">
                   Leave Types
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-responsive-md">
                           <thead>
                               <tr>
                                   <th style="width:80px;"><strong>#</strong></th>
                                   <th><strong>Leave Title</strong></th>
                                   <th><strong>Leave Total days Allowed</strong></th>
                                   <th></th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr v-for="(type, index) in leave_types.data">
                                   <td>@{{ index + 1 }}</td>
                                   <td>@{{ type.name }}</td>
                                   <td>@{{ type.total_days}} Days Leave</td>
                                   <td>
                                       <div class="d-flex">
                                           <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"
                                               @click="get_single_leave_type(type)"><i
                                                   class="fa fa-pen text-white"></i></a>
                                       </div>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="card-footer">
                   <vue-pagination :total-items="leave_types.total" :page="page" :loading="loading_leave_type"
                       :items-per-page="leave_types.per_page" v-on:page-change="pageChange">
                   </vue-pagination>
               </div>
           </div>
       </div>
   </div>


   <div class="modal fade" id="leave_type_detail" data-backdrop="static" data-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="staticBackdropLabel">Leave Type Details</h5>
               </div>
               <div class="modal-body">
                   <label>Leave Type Name</label>
                   <input class="form-control form-controol-sm mb-3" type="text" v-model="leave_type.name" />

                   <label>Leave Days</label>
                   <input class="form-control form-control-sm" type="number" v-model="leave_type.total_days" />
               </div>
               <div class="modal-footer">
                   <div id="modal-close-library"></div>
                   <button type="button" class="btn btn-primary btn-xs"
                       @click="save_update(leave_type.id)">Update</button>
               </div>
           </div>
       </div>
   </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/leave-type.js')}}"></script>
@endsection
