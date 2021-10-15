@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Teachers</h2>
            <p class="mb-0">All School Teachers</p>
        </div>
        <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z"
                            fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                    <span class="d-block fs-16">Select Institution</span>
                    <v-select :options="institutions" label="name" v-model="selected_institution"
                        :reduce="institutions => institutions.id" @input="get_teachers" id="institution"></v-select>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All Teachers
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>S/N</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Email</strong></th>
                                    <th><strong>Gender</strong></th>
                                    <th><strong>Identification Number</strong></th>
                                    <th><strong>Status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(teacher, index) in teachers.data">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center"><img :src="teacher.full_image_path"
                                                class="rounded-lg mr-2" width="24" alt="" /> <span
                                                class="w-space-no">@{{teacher.full_name_text}}</span></div>
                                    </td>
                                    <td>@{{teacher.user.email}}</td>
                                    <td>@{{teacher.gender}}</td>
                                    <td>@{{ teacher.user.school_identification_number }}</td>
                                    <td v-if="teacher.user.status == 0">
                                        <div class="d-flex align-items-center"><i
                                                class="fa fa-circle text-success mr-1"></i>
                                            @{{teacher.user.status_text}}</div>
                                    </td>
                                    <td v-else>
                                        <div class="d-flex align-items-center"><i
                                                class="fa fa-circle text-danger mr-1"></i>
                                            @{{teacher.user.status_text}}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a @click="view(teacher.slug)"
                                                class="btn btn-info shadow btn-xs sharp mr-1"><i
                                                    class="fa fa-eye text-white"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a @click="update(teacher.slug)"
                                                class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                    class="fa fa-pencil text-white"></i></a>
                                        </div>
                                    </td>
                                    <td v-if="teacher.user.status == 0">
                                        <div class="d-flex">
                                            <a @click="ban_teacher(teacher.user.id)"
                                                class="btn btn-danger shadow btn-xs sharp mr-1"><i
                                                    class="fa fa-ban text-white"></i></a>
                                        </div>
                                    </td>
                                    <td v-else>
                                        <div class="d-flex">
                                            <a @click="activate_teacher(teacher.user.id)"
                                                class="btn btn-success shadow btn-xs sharp mr-1"><i
                                                    class="fa fa-check text-white"></i></a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination :total-items="teachers.total" :page="page" :loading="loading_teachers"
                        :items-per-page="teachers.per_page" v-on:page-change="pageChange">
                    </vue-pagination>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade teacher-details-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teacher Details</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="containe">
                        <div class="d-flex align-items-center text-center">
                            <img :src="teacher.full_image_path" class="rounded-lg mr-2 text-center" width="114"
                                alt="" />
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Full Name</h5>
                                <p class="mb-4">@{{teacher.full_name_text}}</p>

                                <h5>Gender</h5>
                                <p class="mb-4">@{{teacher.gender}}</p>

                                <h5>Qualification</h5>
                                <p class="mb-4">@{{teacher.qualification}}</p>

                                <h5>Address</h5>
                                <p class="mb-4">@{{teacher.present_address}}</p>

                                <h5>Nationality</h5>
                                <p class="mb-4">@{{teacher.country.name}}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Email</h5>
                                <p class="mb-4">@{{teacher.user.email}}</p>

                                <h5>Date Of Birth</h5>
                                <p class="mb-4">@{{teacher.date_of_birth_text}} | @{{teacher.date_of_birth}}</p>

                                <h5>Religion</h5>
                                <p class="mb-4">@{{teacher.religion}}</p>

                                <h5>State Of Origin</h5>
                                <p class="mb-4">@{{teacher.state.name}} State</p>

                                <h5>Joined</h5>
                                <p class="mb-4">@{{teacher.created_at_text}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/all-teachers.js')}}"></script>
@endsection
