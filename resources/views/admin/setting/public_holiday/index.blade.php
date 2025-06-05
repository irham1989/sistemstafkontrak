@extends('layouts.backend.master')

@section('title')
    Senarai Cuti Umum
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Senarai Cuti Umum</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="search float-end mb-4">
                                    <input id="ph-list-search" class="form-control" value="" style="outline: none"
                                           placeholder="Search..">
                                </div>
                                <table class="table table-bordered text-center align-middle" id="ph-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 25%">Tahun</th>
                                        <th style="width: 25%">Negeri</th>
                                        <th style="width: 25%">Cuti</th>
                                        <th style="width: 25%">Tarikh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="ph-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="ph-next">Next</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.setting.public_holiday.modals.public-holiday-modal')
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    <script src="{{ asset('js/custom/modals.js') }}"></script>
    <script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = `admin/setting/public-holiday/`;
    </script>

    <script src="{{ asset('js/modules/admin/setting/public-holiday/init.js') }}"></script>
    <script src="{{ asset('js/modules/admin/setting/public-holiday/index.js') }}"></script>
@endsection
