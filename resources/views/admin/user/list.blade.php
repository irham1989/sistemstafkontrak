@extends('layouts.backend.master')

@section('title')
    Senarai Pengguna
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Senarai Pengguna</h3>
                    @if($session_id)
                        <div class="card-toolbar">
                            <a href="{{ route('admin.course.setup', ['session_id' => $session_id]) }}" type="button" class="btn btn-sm btn-danger">
                                Kembali Ke Sesi
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="float-start mb-4">
                                    <button class="btn btn-success" id="user-add"><i
                                            class="fas fa-add fs-4 pe-0"></i></button>
                                </div>
                                <div class="search float-end mb-4">
                                    <input id="user-list-search" class="form-control" value="" style="outline: none"
                                           placeholder="Search..">
                                </div>
                                <table class="table table-bordered text-center align-middle" id="user-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 20%">E-Mel</th>
                                        <th style="width: 20%">Role</th>
                                        <th style="width: 20%">Status</th>
                                        <th style="width: 20%">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="user-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="user-next">Next</button>
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
    @include('admin.user.modals.user-modal')
@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    <script src="{{ asset('js/custom/modals.js') }}"></script>
    <script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = `admin/user/`;
    </script>

    <script src="{{ asset('js/modules/admin/user/init6.js') }}"></script>
    <script src="{{ asset('js/modules/admin/user/index6.js') }}"></script>
@endsection
