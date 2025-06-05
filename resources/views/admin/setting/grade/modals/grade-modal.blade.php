<input type="hidden" id="grade-id" value="">
<div class="modal fade" tabindex="-1" id="grade-modal">
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
                        <label for="grade-name" class="required form-label">Nama</label>
                        <input type="text" id="grade-name" class="form-control" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>

                <button type="button" class="btn btn-success" id="grade-store-add">
                    <span class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Sedang Diproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-warning" id="grade-store-update">
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
