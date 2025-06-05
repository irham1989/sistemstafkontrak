@extends('layouts.backend.master')

@section('title')
    Senarai Penempatan
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Senarai Penempatan IKMa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="float-start mb-4">
                                    <button class="btn btn-success" id="branch-add"><i
                                            class="fas fa-add fs-4 pe-0"></i></button>
                                </div>
                                <div class="search float-end mb-4">
                                    <input id="branch-list-search" class="form-control" value="" style="outline: none"
                                           placeholder="Search..">
                                </div>
                                <table class="table table-bordered text-center align-middle" id="branch-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 45%">Penempatan</th>
                                        <th style="width: 45%">Negeri</th>
                                        <th style="width: 10%">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="branch-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="branch-next">Next</button>
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
    @include('admin.branch.modals.branch-modal')
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    <script src="{{ asset('js/custom/modals.js') }}"></script>
    <script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = `admin/branch/`;
    </script>

    <script src="{{ asset('js/modules/admin/branch/init.js') }}"></script>
    <script src="{{ asset('js/modules/admin/branch/index.js') }}"></script>
@endsection
