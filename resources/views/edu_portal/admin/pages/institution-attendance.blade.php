@extends('edu_portal.admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Institution Attendance setup</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                    <li class="breadcrumb-item active">Setup</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-lg">
            <div class="card-header">Attendance setup</div>
            <div class="card-body">


                <label for="" class="mt-3">Academic session</label>
                <v-select :options="sessions" label="name" v-model="selected_session"
                    :reduce="sessions => sessions.id" @input="get_terms" id="institution" class="mb-3"></v-select>

                <span class="mt-3">Select Term <span class="text-danger">*</span></span>
                <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id"
                    id="terms"></v-select>

                <label class="mt-3">Total Number of days</label>
                <input class="form-control form-control-sm" type="number" v-model="total_days"/>

                <button class="btn btn-sm btn-primary mt-3 btn-block" @click="save_attendance_setup">
                    <i class="fa fa-paper-plane"></i> submit
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header">
               <div class="row">
                     <div class="col-md-6">
                         Attendance Setups
                     </div>
                     <div class="col-md-6 text-right">
                         <span class="d-block fs-16">Select Institution</span>
                         <v-select :options="institutions" label="name" v-model="selected_institution"
                             :reduce="institutions => institutions.id" @input="get_sessions" id="institution">
                         </v-select>
                     </div>
               </div>
            </div>
            <div class="card-body">
                <div class="tabler-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institution</th>
                                <th scope="col">Academic session</th>
                                <th scope="col">Total days</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(attendance, index) in attendance_setups" :key="index">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ attendance.institution ? attendance.institution.name : '' }}</td>
                                <td>@{{ attendance.session ? attendance.session.name : '' }}</td>
                                <td>@{{ attendance.total_days }} total days</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" @click="edit_attendance_setup(attendance)">
                                        <i class="fa fa-pen"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="edit_attendance_setup">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Edit Attendance setup</h5>
              </div>
              <div class="modal-body">
                <label>Total Days</label>
                <input class="form-control form-control-sm" type="number" v-model="single_attendance.total_days"/>
              </div>
              <div class="modal-footer">
                  <div id="modal-close-library"></div>
                  <button type="button" class="btn btn-primary" @click="save_update">Save Update</button>
              </div>
          </div>
      </div>
  </div>



@endsection
@section('script')
     <script src="{{asset('easy_school/admin/plugins/pages/institution-attendance-setup.js')}}"></script>
@endsection
