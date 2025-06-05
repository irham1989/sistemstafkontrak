@php use Illuminate\Support\Facades\Auth; @endphp
<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Tetapan Kata Laluan</h3>
                @if(Auth::user()->hasRole('super-admin|admin'))
                    <div class="card-toolbar">
                        <a href="{{ route('admin.user.list') }}" class="btn btn-sm btn-danger">
                            Kembali Ke Senarai Pengguna
                        </a>
                    </div>
                @endif
            </div>
            <form method="post" action="{{ route('staff.reset-password') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        @if(!empty($errors))
                            @foreach($errors->get('password') as $e)
                                <div class="text-center text-danger fw-bold">
                                    {{ $e }}
                                </div>
                            @endforeach
                        @endif
                        @if(session('success'))
                                <div class="text-center text-success fw-bold">
                                    Kata Laluan Dikemaskini
                                </div>
                        @endif
                        <div class="col-md-6 vals-row mt-4">
                            <label for="password" class="required form-label">Kata Laluan</label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 vals-row mt-4">
                            <label for="password-confirm" class="required form-label">Konfirmasi Kata Laluan</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $staff->getUser->id }}">
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button class="btn btn-success hover-scale me-2" id="update-profile">
                        <span class="indicator-label">
                            Kemaskini
                        </span>
                        <span class="indicator-progress">
                            Sedang Diproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="other-education-flag" value="0">
<input type="hidden" id="other-sector-flag" value="0">
