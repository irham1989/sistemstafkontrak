@php use App\Models\CourseCategory;use Illuminate\Support\Facades\Auth; @endphp
<div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
     id="kt_app_header_menu" data-kt-menu="true">
    <!--begin:Menu item-->
    <div class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-title">Selamat Datang, {{ ucwords(Auth::user()->name) }}</span>
            <span class="menu-arrow d-lg-none"></span>
        </span>
        <!--end:Menu link-->
    </div>
    @role('peserta')
        @php
            $courseCategories = CourseCategory::where('deleted', false)->get();
            $monthStart = 1;
            $months = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];
        @endphp
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
             class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Kategori Kursus</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('participant.catalog.list', ['user_id' => Auth::user()->id]) }}"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                       data-bs-placement="right">
                        <span class="menu-title">Semua Kategori</span>
                    </a>

                    <!--end:Menu link-->
                </div>
                @if(count($courseCategories) > 0)
                    @foreach($courseCategories as $cc)
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('participant.catalog.list', ['user_id' => Auth::user()->id, 'category' => $cc->id]) }}"
                               data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                               data-bs-placement="right">
                                <span class="menu-title">{{ $cc->name }}</span>
                            </a>

                            <!--end:Menu link-->
                        </div>
                    @endforeach
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
             class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link">
                    <span class="menu-title">Bulan (Tahun {{ date('Y') }})</span>
                    <span class="menu-arrow d-lg-none"></span>
                </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('participant.catalog.list', ['user_id' => Auth::user()->id]) }}"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                       data-bs-placement="right">
                        <span class="menu-title">Semua Bulan</span>
                    </a>

                    <!--end:Menu link-->
                </div>
                @foreach($months as $m)
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('participant.catalog.list', ['user_id' => Auth::user()->id, 'month' => $monthStart]) }}"
                           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                           data-bs-placement="right">
                            <span class="menu-title">{{ $m }}</span>
                        </a>
                        @php
                            $monthStart++;
                        @endphp
                        <!--end:Menu link-->
                    </div>
                @endforeach
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endrole
    <!--end:Menu item-->
</div>
