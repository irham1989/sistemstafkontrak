@php use Illuminate\Support\Facades\Auth; @endphp
<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Akademik</h3>
                @if(Auth::user()->hasRole('super-admin|admin'))
                    <div class="card-toolbar">
                        <a href="{{ route('admin.user.list') }}" class="btn btn-sm btn-danger">
                            Kembali Ke Senarai Pengguna
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="float-start mb-4">
                                    <button class="btn btn-success" id="academic-add"><i
                                            class="fas fa-add fs-4 pe-0"></i>
                                    </button>
                                </div>
                                <table class="table table-bordered text-center align-middle" id="academic-list">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                        <th style="width: 30%">Institusi</th>
                                        <th style="width: 20%">Sijil</th>
                                        <th style="width: 30%">Pengkhususan</th>
                                        <th style="width: 10%">Gred Keseluruhan</th>
                                        <th style="width: 10%">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pagination">
                                        <li class="page-item previous">
                                            <button class="page-link page-text" id="academic-prev">Previous</button>
                                        </li>
                                        <li class="page-item next">
                                            <button class="page-link page-text" id="academic-next">Next</button>
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
</div>
