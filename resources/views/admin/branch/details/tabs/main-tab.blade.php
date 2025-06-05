<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Maklumat Asas Penempatan</h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.branch.index') }}" class="btn btn-sm btn-danger">
                        Kembali Ke Senarai Penempatan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4 vals-row mt-4">
                        <label for="salutation" class="required form-label">Nama Gelaran</label>
                        <input type="text" class="form-control text-uppercase" id="name" value="{{ strtoupper($branch->name) }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 mt-4 vals-row">
                        <label for="state" class="required form-label">Negeri</label>
                        <select class="form-control" id="state" name="state" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($state as $st)
                                <option value="{{ $st->id }}" {{ $branch->state_id ? $st->id == $branch->state_id ? 'selected' : '' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 mt-4 vals-row">
                        <label for="hq" class="required form-label">Adakah Penempatan Ini HQ?</label>
                        <select id="hq" class="form-control" data-control="select2">
                            <option value="0" {{ $branch->hq == false ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ $branch->hq == true ? 'selected' : '' }}>Ya</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                @php
                    $saveDisabled = false;
                @endphp
                <button class="btn btn-success hover-scale me-2" id="branch-store-update" {{ $saveDisabled ? 'disabled' : '' }}>
                    <span class="indicator-label">
                        Kemaskini
                    </span>
                    <span class="indicator-progress">
                        Sedang Diproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
