@php use App\Models\ApplicantStatus;use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.backend.master')
@section('title')
    {{ $staff->getUser->name }} - Profil
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Profil</a>
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Name-->
                        </div>
                        <!--end::User-->
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-6 text-gray-700">Penempatan</div>
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center text-uppercase">
                                        <div class="fs-2 fw-bold">
                                            @if($staff->getStaffPosition->branch_position_id)
                                                <span class="text-info">{{ $staff->getStaffPosition->getBranch->name }}</span><br>
                                                <span class="text-success">
                                                <span class="text-success">
                                                    {{ $staff->getStaffPosition->getBranchPosition->getPosition->name ?? '' }}
                                                    ({{ $staff->getStaffPosition->getBranchPosition->getGrade->name ?? '' }})
                                                </span>
                                            </span>
                                            @else
                                                <span class="text-dark">Sila Pilih Jawatan</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-6 text-gray-700">Umur</div>
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold">{{ $staff->dob ? date('Y') - date('Y', strtotime($staff->dob)) : '-' }}</div>
                                    </div>
                                    <!--end::Number-->
                                </div>

                                <div class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-6 text-gray-700">Tarikh Lantikan</div>
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center text-uppercase">
                                        <div class="fs-2 fw-bold">
                                            <div class="col-md-12 vals-row mt-4">
                                                @role('super-admin|admin')
                                                    <input type="text" id="appointed-date" class="form-control" value="{{ $staff->date_appointed ? date('d-m-Y', strtotime($staff->date_appointed)) : '' }}">
                                                @endrole
                                                @role('approval-admin|staff|ketua_unit|penolong_pengarah|ketua_pengarah')
                                                    {{ $staff->date_appointed ? date('d-m-Y', strtotime($staff->date_appointed)) : '' }}
                                                @endrole

                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                </div>

                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    @if($staff->getStaffPosition->branch_position_id)
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                        <div class="fw-semibold fs-6 text-gray-700">Jumlah Cuti</div>
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bold">{{ $staff->getStaffPosition->getStaffLeave->leave_total }} Hari</div>
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                        <div class="fw-semibold fs-6 text-gray-700">Jumlah Cuti Diambil</div>
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bold">{{ $staff->getStaffPosition->getStaffLeave->leave_taken }} Hari</div>
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-auto py-3 px-4 me-6 mb-3">
                                        <div class="fw-semibold fs-6 text-gray-700">Baki Cuti</div>
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bold">{{ $staff->getStaffPosition->getStaffLeave->leave_balance }} Hari</div>
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <!--begin::Navs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'main' ? 'active' : '' }}"
                       href="{{ route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'main']) }}">Rekod Peribadi</a>
                </li>

                @if($staff->profile_complete == 1)
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'family' ? 'active' : '' }}"
                           href="{{ route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'family']) }}">Maklumat Keluarga</a>
                    </li>
                @endif
                @if($staff->profile_complete == 1)
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'academic' ? 'active' : '' }}"
                           href="{{ route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'academic']) }}">
                            @if(!$staff->academic_complete)
                                <span class="badge badge-circle badge-outline badge-danger me-2">!</span>
                            @endif
                            Akademik
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('super-admin|admin'))
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'position' ? 'active' : '' }}"
                               href="{{ route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'position']) }}">Tetapan Jawatan</a>
                        </li>
                    @endif
                @endif
                @if(Auth::user()->hasRole('super-admin|admin'))
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'resetpassword' ? 'active' : '' }}"
                           href="{{ route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'resetpassword']) }}">Tetapan Kata Laluan</a>
                    </li>
                @endif
            </ul>
            <!--begin::Navs-->
        </div>
    </div>
    @if($page == 'main')
        @include('staff.profile.tabs.profile-tab')
    @elseif($page == 'academic')
        @include('staff.profile.modals.academic-modal')
        @include('staff.profile.tabs.academic-tab')
    @elseif($page == 'resetpassword')
        @include('staff.profile.tabs.password-tab')
    @elseif($page == 'position')
        @include('staff.profile.tabs.position-tab')
    @elseif($page == 'family')
        @include('staff.profile.modals.family-modal')
        @include('staff.profile.tabs.family-tab')
    @endif
    <input type="hidden" id="staff-id" value="{{ $staff->id }}">
    <input type="hidden" id="user-id" value="{{ $staff->getUser->id }}">
    <input type="hidden" id="page" value="{{ $page }}">
    <input type="hidden" id="state-select" value="{{ $state_select ?? null }}">
    <input type="hidden" id="branch-select" value="{{ $branch_select ?? null }}">
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/modals.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = 'staff/profile/';
        let staff_id = $('#staff-id').val();
        let user_id = $('#user-id').val();
        let page = $('#page').val();
        $("#appointed-date").flatpickr({
            dateFormat: "d-m-Y",
        });

        $('#appointed-date').on('change', function(e){
            let v = common.getForm(false)
            v.append('date', $(this).val())
            v.append('staff_id', user_id)

            http.fetch({
                url: `${common.getUrl()}${moduleUrl}store-update-appointed`,
                data: v,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        alerting.fireSwal({
                            text: r.data.message,
                            icon: 'success',
                            buttonColor: 'btn btn-success',
                            confirmButton: 'Close',
                            callback: function(){
                                window.location.reload()
                            }
                        })
                    }else{
                        alerting.error(r.data);
                    }
                }
            })
        })
    </script>

    @if($page == 'main')
        <script src="{{ asset('js/modules/staff/profile/init4.js') }}"></script>
        <script src="{{ asset('js/modules/staff/profile/index4.js') }}"></script>
    @elseif($page == 'academic')
        <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
        <script src="{{ asset('js/modules/staff/academic/init4.js') }}"></script>
        <script src="{{ asset('js/modules/staff/academic/index4.js') }}"></script>
    @elseif($page == 'position')
        <script src="{{ asset('js/modules/staff/position/init.js') }}"></script>
        <script src="{{ asset('js/modules/staff/position/index.js') }}"></script>
    @elseif($page == 'family')
        <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
        <script src="{{ asset('js/modules/staff/family/init4.js') }}"></script>
        <script src="{{ asset('js/modules/staff/family/index4.js') }}"></script>
    @endif
@endsection

