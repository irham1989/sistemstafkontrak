<input type="hidden" id="academic-id" value="">
<div class="modal fade" tabindex="-1" id="academic-modal" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                    <div class="col-md-4 mb-4 vals-row">
                        <label for="qualification" class="required form-label">Tahap Pendidikan</label>
                        <select class="form-control" id="qualification" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($academic_qualifications as $aq)
                                <option value="{{ $aq->id }}">{{ $aq->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-8 vals-row mb-4">
                        <label for="cert-name" class="required form-label">Nama Sijil</label>
                        <input type="text" class="form-control text-uppercase" id="cert-name" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 vals-row mb-4">
                        <label for="institution-name" class="required form-label">Nama Institusi</label>
                        <textarea class="form-control" id="institution-name"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 vals-row mb-4">
                        <label for="institution-location" class="required form-label">Lokasi Institusi</label>
                        <textarea class="form-control" id="institution-location"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 vals-row mb-4">
                        <label for="major-specialization" class="required form-label">Bidang Pengkhuhusan Major</label>
                        <input type="text" class="form-control text-uppercase" id="major-specialization" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 vals-row mb-4">
                        <label for="minor-specialization" class="form-label">Bidang Pengkhuhusan Minor (Jika Ada)</label>
                        <input type="text" class="form-control text-uppercase" id="minor-specialization" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 vals-row mb-4">
                        <label for="profession-cert" class="form-label">Kelayakan Sijil Professional</label>
                        <input type="text" class="form-control text-uppercase" id="profession-cert" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 vals-row mb-4">
                        <label for="profession-cert-date" class="form-label">Tarikh Penganugerahaan</label>
                        <input type="text" class="form-control text-uppercase" id="profession-cert-date" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 vals-row mb-4">
                        <label for="overall-grade" class="form-label">Gred Keseluruhan</label>
                        <input type="text" class="form-control text-uppercase" id="overall-grade" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>

                <button type="button" class="btn btn-success" id="academic-store-add">
                    <span class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Sedang Diproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-warning" id="academic-store-update">
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
