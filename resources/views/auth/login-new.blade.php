<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../" />
    <title>Sistem Pengurusan Staf Kontrak IKMa</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('templates/backend/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('templates/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page bg image-->
    <style>body { background-image: url('{{ asset('templates/backend/assets/media/auth/bg4.jpg') }}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('templates/backend/assets/media/auth/bg4-dark.jpg') }}'); }</style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a href="{{ route('login') }}" class="mb-7">
                    <img alt="Logo" src="{{ asset('assets/images/ikmalogo.png') }}" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">Sistem Pengurusan Staf Kontrak IKMa</h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <!--begin::Card-->
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form action="{{ route('login') }}" class="form w-100" method="post">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder mb-3">Sila Masuk Log Masuk</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Masukkan E-Mel Dan Kata Laluan Anda</div>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="E-mel/No. Kad Pengenalan" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}" required/>
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Kata Laluan" name="password" autocomplete="off" class="form-control bg-transparent" required/>
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="{{ route('password.request') }}" class="link-primary">Lupa Kata Laluan ?</a>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Log Masuk</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
{{--                        <div class="text-gray-500 text-center fw-semibold fs-6">Akaun Baru?--}}
{{--                            <a href="{{ route('register') }}" class="link-primary">Daftar Sekarang</a></div>--}}
                        <!--end::Sign up-->
                    </form>
                    @if(!empty($errors))
                        @foreach($errors->get('email') as $e)
                            <div class="text-center text-danger fw-bold">
                                {{ $e }}
                            </div>
                        @endforeach
                    @endif
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Footer-->
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('templates/backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
