@php use Illuminate\Support\Facades\Auth; @endphp
<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Tetapan Jawatan</h3>
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
                    @if($staff->getStaffPosition->branch_position_id)
                        <div class="col-md-12 mb-4 vals-row mt-4 text-uppercase">
                            JAWATAN TERKINI:<br>
                            <span class="text-info">{{ $staff->getStaffPosition->getBranch->name }}</span><br>
                            <span class="text-success">
                                {{ $staff->getStaffPosition->getBranchPosition->getPosition->name ?? '' }}
                                ({{ $staff->getStaffPosition->getBranchPosition->getGrade->name ?? '' }})
                            </span>
                        </div>
                    @endif

                    <div class="col-md-4 mb-4 vals-row mt-4">
                        <label for="state-select" class="required form-label">Pilih Negeri</label>
                        <select class="form-control" id="state-select" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($state as $s)
                                <option value="{{ $s->id }}" {{ $state_select ? $state_select == $s->id ? 'selected' : '' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    @if(isset($state_select))
                        <div class="col-md-4 mb-4 vals-row mt-4">
                            <label for="branch-select" class="required form-label">Pilih Penempatan</label>
                            <select class="form-control" id="branch-select">
                                @if(isset($branch_record))
                                    <option value="{{ $branch_record['id'] }}">{{ $branch_record['name'] }}</option>
                                @else
                                    <option>Sila Pilih</option>
                                @endif

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    @endif
                    @if(isset($branch_select))
                        <div class="col-md-4 mb-4 vals-row mt-4">
                            <label for="position-select" class="required form-label">Pilih Jawatan/Gred</label>
                            <select class="form-control" id="position-select">
                                <option>Sila Pilih</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    @endif
                </div>
            </div>
            @if(isset($branch_select))
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    @php
                        $saveDisabled = false;
                    @endphp
                    <button class="btn btn-success hover-scale me-2" id="update-position" {{ $saveDisabled ? 'disabled' : '' }}>
                        <span class="indicator-label">
                            Simpan
                        </span>
                        <span class="indicator-progress">
                            Saving... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    @if($staff->getStaffPosition->branch_position_id)
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Pintasan Cuti (Jika Perlu)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 vals-row mt-4">
                            <label for="new-leave-balanc" class="required form-label">Jumlah Cuti Baru</label>
                            <input type="text" id="new-leave-balance" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    @php
                        $saveDisabled = false;
                    @endphp
                    <button class="btn btn-success hover-scale me-2" id="update-leave-balance" {{ $saveDisabled ? 'disabled' : '' }}>
                    <span class="indicator-label">
                        Simpan
                    </span>
                        <span class="indicator-progress">
                        Saving... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
