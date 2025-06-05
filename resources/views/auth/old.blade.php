<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../../" />
    <title>Sistem Pengurusan Staf Kontrak IKMa</title>
    <meta charset="utf-8" />
    <meta name="description" content="EIC CRM SYSTEM" />
    <meta name="keywords" content="property, management, property management, affordable, affordable property management" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/images/newfavicon.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('templates/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<body id="kt_body" class="app-blank">
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form action="{{ route('login') }}" class="form w-100" method="post">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Selamat Datang <br>Sistem Pengurusan Staf Kontrak IKMa</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Sila Log Masuk Sekarang</div>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="E-mel/No. Kad Pengenalan" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}" required/>
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Kata Laluan" name="password" autocomplete="off" class="form-control bg-transparent" required/>
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="{{ route('password.request') }}" class="link-primary">Lupa Kata Laluan ?</a>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Log Masuk</span>
                            </button>
                        </div>
                    </form>
                    @if(!empty($errors))
                        @foreach($errors->get('email') as $e)
                            <div class="text-center text-danger fw-bold">
                                {{ $e }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
{{--            <div class="p-10 text-center gap-5 fw-semibold ">--}}
{{--                Tiada Akaun?<a class="m-4 text-primary" href="{{ route('register') }}">Daftar Sekarang</a>--}}
{{--            </div>--}}
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/images/auth_background.png') }})">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="index.html" class="mb-0 mb-lg-12 p-5" style="background-color: white;border-radius: 20px">
                    <img alt="Logo" src="{{ asset('assets/images/ikmalogo.png') }}" class="h-60px h-lg-100px" />
                </a>
            </div>
        </div>
    </div>
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('templates/backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('templates/backend/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
</body>
<!--end::Body-->
</html>
