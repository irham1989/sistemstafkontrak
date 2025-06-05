@extends('layouts.backend.master')

@section('title')
    Senarai Gred
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Senarai Gred</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="float-start mb-4">
                                    <button class="btn btn-success" id="grade-add"><i
                                            class="fas fa-add fs-4 pe-0"></i></button>
                                </div>
                                <div class="search float-end mb-4">
                                    <input id="grade-list-search" class="form-control" value="" style="outline: none"
                                           placeholder="Search..">
                                </div>
                                <table class="table table-bordered text-center align-middle" id="grade-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 90%">Name</th>
                                        <th style="width: 10%">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="grade-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="grade-next">Next</button>
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
    @include('admin.setting.grade.modals.grade-modal')
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    <script src="{{ asset('js/custom/modals.js') }}"></script>
    <script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = `admin/setting/grade/`;
    </script>

    <script src="{{ asset('js/modules/admin/setting/grade/init.js') }}"></script>
    <script src="{{ asset('js/modules/admin/setting/grade/index.js') }}"></script>
@endsection
