@php use Illuminate\Support\Facades\Auth; @endphp
<div class="row gx-5 gx-xl-10 mb-xl-10">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Rekod Peribadi</h3>
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
                    <div class="col-md-2 mb-4 vals-row mt-4">
                        <label for="salutation" class="required form-label">Nama Gelaran</label>
                        <select class="form-control" id="salutation" name="salutation" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($salutation as $st)
                                <option value="{{ $st->id }}" {{ $staff->salutation_id ? $st->id == $staff->salutation_id ? 'selected' : '' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 vals-row mt-4">
                        <label for="name" class="required form-label">Nama</label>
                        <input type="text" class="form-control text-uppercase" id="name" name="name" value="{{ $staff->getUser->name }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 vals-row mt-4">
                        <label for="identification-no" class="required form-label">No. Kad Pengenalan</label>
                        <input type="text" class="form-control text-uppercase" id="identification-no" name="identification_no" value="{{ $staff->getUser->ic_no }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 vals-row mt-4">
                        <label for="email" class="required form-label">E-Mel</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $staff->getUser->email }}" disabled>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mb-4 vals-row mt-4">
                        <label for="mobile-phone" class="required form-label">No. Telefon</label>
                        <input type="text" class="form-control" id="mobile-phone" name="mobile_phone" value="{{ $staff->phone_no }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mt-4 vals-row">
                        <label for="gender" class="required form-label">Jantina</label>
                        <select class="form-control" id="gender" name="gender" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($gender as $gd)
                                <option value="{{ $gd->id }}" {{ $staff->gender_id ? $gd->id == $staff->gender_id ? 'selected' : '' : '' }}>{{ $gd->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mb-4 vals-row mt-4">
                        <label for="religion" class="required form-label">Agama</label>
                        <select class="form-control" id="religion" name="religion" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($religion as $rg)
                                <option value="{{ $rg->id }}" {{ $staff->religion_id ? $rg->id == $staff->religion_id ? 'selected' : '' : '' }}>{{ $rg->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mb-4 vals-row mt-4">
                        <label for="marital" class="required form-label">Taraf Perkahwinan</label>
                        <select class="form-control" id="marital" name="marital" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($marital_status as $ms)
                                <option value="{{ $ms->id }}" {{ $staff->marital_status_id ? $ms->id == $staff->marital_status_id ? 'selected' : '' : '' }}>{{ $ms->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mb-4 vals-row mt-4">
                        <label for="dob" class="required form-label">Tarikh Lahir</label>
                        <input type="text" class="form-control" id="dob" name="dob" value="{{ $staff->dob }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mb-4 vals-row mt-4">
                        <label for="birth-certificate" class="required form-label">No. Sijil Lahir</label>
                        <input type="text" class="form-control" id="birth-certificate" name="birth_certificate" value="{{ $staff->birth_certificate_no }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mt-4 vals-row mt-4">
                        <label for="birth-country" class="required form-label">Negara Lahir</label>
                        <select class="form-control" id="birth-country" name="birth_country" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($country as $cou)
                                <option value="{{ $cou->id }}" {{ $staff->birth_country_id ? $cou->id == $staff->birth_country_id ? 'selected' : '' : ''}}>{{ $cou->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mt-4 vals-row">
                        <label for="birth-state" class="required form-label">Negeri Lahir</label>
                        <select class="form-control" id="birth-state" name="birth_state" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($state as $st)
                                <option value="{{ $st->id }}" {{ $staff->birth_state_id ? $st->id == $staff->birth_state_id ? 'selected' : '' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mt-4 vals-row">
                        <label for="race" class="required form-label">Bangsa</label>
                        <select class="form-control" id="race" name="race" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($race as $bd)
                                <option data-other="{{ $bd->other_flag }}" value="{{ $bd->id }}" {{ $staff->race_id ? $bd->id == $staff->race_id ? 'selected' : '' : '' }}>{{ $bd->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 mb-4 vals-row mt-4">
                        <label for="race-other" class="required form-label">Lain-Lain, Nyatakan</label>
                        <input type="text" class="form-control" id="race-other" name="race_other" value="{{ $staff->other_race }}" {{ $staff->other_race ? '' : 'disabled' }}>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-2 mb-4 vals-row mt-4">
                        <label for="blood-type" class="required form-label">Jenis Darah</label>
                        <select class="form-control" id="blood-type" name="blood-type" data-control="select2">
                            <option>Sila Pilih</option>
                            <option value="A" {{ $staff->blood_type == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $staff->blood_type == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ $staff->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ $staff->blood_type == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 mt-4 vals-row">
                        <label for="bumiputera" class="required form-label">Bumiputera</label>
                        <select class="form-control" id="bumiputera" name="bumiputera" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($bumiputera as $bp)
                                <option data-other="{{ $bp->other_flag }}" value="{{ $bp->id }}" {{ $staff->bumiputera_id ? $bp->id == $staff->bumiputera_id ? 'selected' : '' : '' }}>{{ $bp->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">

{{--                    <div class="col-md-4 mb-4 vals-row mt-4">--}}
{{--                        <label for="bumiputera-other" class="required form-label">Lain-Lain, Nyatakan</label>--}}
{{--                        <input type="text" class="form-control" id="bumiputera-other" name="bumiputera_other" value="{{ $staff->bumiputera_other }}" {{ $staff->bumiputera_other ? '' : 'disabled' }}>--}}
{{--                        <div class="invalid-feedback"></div>--}}
{{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="col-md-12 vals-row mt-4">
                        <label for="address" class="required form-label">Alamat</label>
                        <textarea class="form-control text-uppercase" rows="4" id="address">{{$staff->address }}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 mb-4 vals-row mt-4">
                        <label for="city" class="required form-label">Daerah</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ $staff->city }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-2 mb-4 vals-row mt-4">
                        <label for="postal-code" class="required form-label">Poskod</label>
                        <input type="text" class="form-control" id="postal-code" name="postal_code" value="{{ $staff->postal_code }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mt-4 vals-row mt-4">
                        <label for="country" class="required form-label">Negara</label>
                        <select class="form-control" id="country" name="country" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($country as $cou)
                                <option value="{{ $cou->id }}" {{ $staff->country_id ? $cou->id == $staff->country_id ? 'selected' : '' : ''}}>{{ $cou->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3 mt-4 vals-row">
                        <label for="state" class="required form-label">Negeri</label>
                        <select class="form-control" id="state" name="state" data-control="select2">
                            <option>Sila Pilih</option>
                            @foreach($state as $st)
                                <option value="{{ $st->id }}" {{ $staff->state_id ? $st->id == $staff->state_id ? 'selected' : '' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                @php
                    $saveDisabled = false;
                @endphp
                <button class="btn btn-success hover-scale me-2" id="update-profile" {{ $saveDisabled ? 'disabled' : '' }}>
                    <span class="indicator-label">
                        Save
                    </span>
                    <span class="indicator-progress">
                        Saving... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
