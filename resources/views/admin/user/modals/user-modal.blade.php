<input type="hidden" id="user-id" value="">
<div class="modal fade" tabindex="-1" id="user-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 vals-row mb-4">
                        <label for="name" class="required form-label">Nama</label>
                        <input type="text" class="form-control text-uppercase" id="name" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-12 vals-row mb-4">
                        <label for="name" class="required form-label">E-Mel</label>
                        <input type="text" class="form-control" id="email" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-12 vals-row mb-4">
                        <label for="name" class="required form-label">No. Kad Pengenalan</label>
                        <input type="text" class="form-control text-uppercase" id="identification_no" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-12 vals-row mb-4">
                        <label for="name" class="required form-label">Role</label>
                        <select id="role" class="form-control" data-control="select2" data-dropdown-parent="#user-modal" data-placeholder="Pilih Role">
                            <option value="">Pilih Role</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->display_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>

                <button type="button" class="btn btn-success" id="user-store-add">
                    <span class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Sedang Diproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-warning" id="user-store-update">
                    <span class="indicator-label">
                        Kemaskini
                    </span>
                    <span class="indicator-progress">
                        Sedang Dikemaskini... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
