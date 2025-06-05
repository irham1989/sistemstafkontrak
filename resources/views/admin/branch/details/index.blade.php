@extends('layouts.backend.master')
@section('title')
    {{ strtoupper($branch->name) }} - Penempatan
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
                                <a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ strtoupper($branch->name) }}</a>
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Name-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
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
                       href="{{ route('admin.branch.details', ['branch_id' => $branch->id, 'page' => 'main']) }}">Maklumat Asas</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $page == 'position' ? 'active' : '' }}"
                       href="{{ route('admin.branch.details', ['branch_id' => $branch->id, 'page' => 'position']) }}">Jawatan</a>
                </li>
                <!--end::Nav item-->
            </ul>
            <!--begin::Navs-->
        </div>
    </div>
    @if($page == 'main')
        @include('admin.branch.details.tabs.main-tab')
    @elseif($page == 'position')
        @include('admin.branch.details.tabs.position-tab')
        @include('admin.branch.details.modals.position-modal')
    @endif
    <input type="hidden" id="branch-id" value="{{ $branch->id }}">
    <input type="hidden" id="page" value="{{ $page }}">
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/modals.js') }}"></script>

    @if($page == 'position')
        <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    @endif
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = 'admin/branch/';
        let branch_id = $('#branch-id').val();
        let page = $('#page').val();
    </script>

    @if($page == 'main')
        <script src="{{ asset('js/modules/admin/branch/details/main/index.js') }}"></script>
    @elseif($page == 'position')
        <script src="{{ asset('js/modules/admin/branch/details/position/init2.js') }}"></script>
        <script src="{{ asset('js/modules/admin/branch/details/position/index2.js') }}"></script>
    @endif
@endsection

