<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Jawatan Bagi Penempatan Ini</h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.branch.index') }}" class="btn btn-sm btn-danger">
                        Kembali Ke Senarai Penempatan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="float-start mb-4">
                                <button class="btn btn-success" id="position-add"><i
                                        class="fas fa-add fs-4 pe-0"></i></button>
                            </div>
                            <div class="search float-end mb-4">
                                <input id="position-list-search" class="form-control" value="" style="outline: none"
                                       placeholder="Search..">
                            </div>
                            <table class="table table-bordered text-center align-middle" id="position-list">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800" style="text-align:center">
                                    <th style="width: 40%">Jawatan</th>
                                    <th style="width: 25%">Gred</th>
                                    <th style="width: 25%">Cuti Asas</th>
                                    <th style="width: 10%">Tindakan</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div>
                                <ul class="pagination">
                                    <li class="page-item previous">
                                        <button class="page-link page-text" id="position-prev">Previous</button>
                                    </li>
                                    <li class="page-item next">
                                        <button class="page-link page-text" id="position-next">Next</button>
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
