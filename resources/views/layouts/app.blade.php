<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>@yield('title', config('app.name', 'Legacy Safe'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fuse.typekit.net">
    <link rel="stylesheet" href="https://use.typekit.net/nan6ioj.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/select2.min.js'])

    @livewireStyles
</head>

<body>


    @guest
        <section class="admin bg-F5F5F5 h-vh">
            <div>
                @yield('content')
            </div>
        </section>
    @endguest

    @auth
        <section class="admin bg-F5F5F5 h-vh">
            <div class="d-flex flex-wrap h-100">

                @include('layouts.partials.sidebar')


                <div class="admin-wrapper h-100 overflow-auto">
                    <div class="container-fluid h-100">
                        <div class="ps-5 h-100">
                            <!-- Header
                        ============================================= -->
                            @include('layouts.partials.header')
                            <!-- Header End -->
                            <!-- Content
                        ============================================= -->
                            @yield('content')
                            <!-- Content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth


    @livewireScripts
</body>
<!-- Page Specific Scripts
    ============================================= -->
    @stack('page-specific-scripts')
    <!-- end of Page Specific Scripts
    ============================================= -->
</html>
