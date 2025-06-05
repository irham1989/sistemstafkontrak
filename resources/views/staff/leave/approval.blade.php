@extends('layouts.backend.master')

@section('title')
    Senarai Pengesahan Permohonan Cuti
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Senarai Pengesahan Permohonan Cuti</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="search float-end mb-4">
                                    <input id="approval-list-search" class="form-control" value="" style="outline: none"
                                           placeholder="Search..">
                                </div>
                                <table class="table table-bordered text-center align-middle" id="approval-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 20%">Nama Pemohon/<br>Tarikh Permohonan</th>
                                        <th style="width: 15%">Tarikh Cuti</th>
                                        <th style="width: 15%">Jumlah Hari</th>
                                        <th style="width: 20%">Sebab Bercuti</th>
                                        <th style="width: 20%">Status</th>
                                        <th style="width: 10%">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="approval-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="approval-next">Next</button>
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
    <input type="hidden" id="user-id" value="{{ $user_id }}">
    <input type="hidden" id="is-super" value="{{ $is_role['superadmin'] }}">
    <input type="hidden" id="is-admin" value="{{ $is_role['admin'] }}">
    <input type="hidden" id="is-approval" value="{{ $is_role['approvaladmin'] }}">
    <input type="hidden" id="is-staff" value="{{ $is_role['staff'] }}">

@endsection

@section('jsExtensions')
    <script src="{{ asset('js/custom/datatable-helper.js') }}"></script>
    <script src="{{ asset('js/custom/modals.js') }}"></script>
    <script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
@endsection

@section('jsCustom')
    <script>
        let moduleUrl = `staff/leave/`;
        let user_id = $('#user-id').val();
        let is_super = $('#is-super').val();
        let is_admin = $('#is-admin').val();
        let is_approval = $('#is-approval').val();
        let is_staff = $('#is-staff').val();
    </script>

    <script src="{{ asset('js/modules/staff/leave/approval/init4.js') }}"></script>
    <script src="{{ asset('js/modules/staff/leave/approval/index4.js') }}"></script>
@endsection
